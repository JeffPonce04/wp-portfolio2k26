(function () {
    'use strict';

    const root = document.getElementById('portfolio2k26-editable-root')
        || document.querySelector('.dev-portfolio-wrapper')
        || document.querySelector('main.portfolio2k26-fallback');

    if (!root || !window.Portfolio2k26Editor || !window.wp || !window.wp.media) return;

    let editMode = false;
    let activeText = null;
    let activeImage = null;
    let activeVideo = null;

    const bar = document.createElement('div');
    bar.id = 'portfolio2k26-editor-bar';
    bar.innerHTML = `
      <strong>Portfolio editor</strong>
      <span class="p26-editor-help">Click text to edit · image to replace · video to update</span>
      <button type="button" id="p26-edit-toggle">Edit page</button>
      <button type="button" id="p26-save" disabled>Save changes</button>
      <span id="p26-editor-status" role="status" aria-live="polite"></span>`;
    document.body.appendChild(bar);

    const toggle = bar.querySelector('#p26-edit-toggle');
    const save = bar.querySelector('#p26-save');
    const status = bar.querySelector('#p26-editor-status');

    function markChanged(message) {
        save.disabled = false;
        status.textContent = message || 'Unsaved changes';
    }

    function clearEditorState(container) {
        container.querySelectorAll('[contenteditable]').forEach((el) => {
            el.removeAttribute('contenteditable');
            el.removeAttribute('spellcheck');
            el.classList.remove('p26-editing-text');
        });
        container.querySelectorAll('.p26-image-selected, .p26-video-selected').forEach((el) => {
            el.classList.remove('p26-image-selected', 'p26-video-selected');
        });
    }

    function setEditMode(enabled) {
        editMode = enabled;
        document.body.classList.toggle('p26-edit-mode', enabled);
        root.classList.toggle('p26-editable', enabled);
        toggle.textContent = enabled ? 'Exit editing' : 'Edit page';
        bar.classList.toggle('is-editing', enabled);
        status.textContent = enabled ? 'Editing is on — select text, images, or video.' : '';

        if (!enabled) {
            clearEditorState(root);
            activeText = null;
            activeImage = null;
            activeVideo = null;
        }
    }

    function openImagePicker(image) {
        activeImage = image;
        activeVideo = null;
        activeText = null;

        root.querySelectorAll('.p26-image-selected').forEach((el) => el.classList.remove('p26-image-selected'));
        image.classList.add('p26-image-selected');

        const frame = window.wp.media({
            title: Portfolio2k26Editor.imageTitle || 'Choose a replacement image',
            button: { text: Portfolio2k26Editor.imageButton || 'Use this image' },
            library: { type: 'image' },
            multiple: false
        });

        frame.on('select', function () {
            const attachment = frame.state().get('selection').first().toJSON();
            if (!activeImage || !root.contains(activeImage) || !attachment.url) return;

            activeImage.src = attachment.url;
            activeImage.removeAttribute('srcset');
            activeImage.removeAttribute('sizes');
            activeImage.removeAttribute('data-src');
            if (attachment.alt) activeImage.alt = attachment.alt;

            activeImage.classList.remove('p26-image-selected');
            markChanged('Image updated — save to publish it.');
        });

        frame.open();
    }

    function openVideoPicker(video) {
        activeVideo = video;
        activeImage = null;
        activeText = null;

        root.querySelectorAll('.p26-video-selected').forEach((el) => el.classList.remove('p26-video-selected'));
        video.classList.add('p26-video-selected');

        const frame = window.wp.media({
            title: Portfolio2k26Editor.videoTitle || 'Choose a replacement video',
            button: { text: Portfolio2k26Editor.videoButton || 'Use this video' },
            library: { type: 'video' },
            multiple: false
        });

        frame.on('select', function () {
            const attachment = frame.state().get('selection').first().toJSON();
            if (!activeVideo || !root.contains(activeVideo) || !attachment.url) return;

            let source = activeVideo.querySelector('source');
            if (source) {
                source.src = attachment.url;
                if (attachment.mime) source.type = attachment.mime;
            } else {
                activeVideo.src = attachment.url;
            }

            activeVideo.load();
            activeVideo.pause();
            activeVideo.classList.remove('p26-video-selected');
            markChanged('Video updated — save to publish it.');
        });

        frame.open();
    }

    toggle.addEventListener('click', function () {
        setEditMode(!editMode);
    });

    root.addEventListener('click', function (event) {
        if (!editMode) return;

        const target = event.target instanceof Element ? event.target : event.target.parentElement;
        if (!target) return;

        const video = target.closest('video') || (target.closest('#presentationVideoPlay') ? root.querySelector('#teamPresentationVideo') : null);
        if (video && root.contains(video)) {
            event.preventDefault();
            event.stopPropagation();
            openVideoPicker(video);
            return;
        }

        const image = target.closest('img');
        if (image && root.contains(image)) {
            event.preventDefault();
            event.stopPropagation();
            openImagePicker(image);
            return;
        }

        const editable = target.closest('h1,h2,h3,h4,h5,h6,p,li,a,button,span,strong,em,blockquote,label,small');
        if (!editable || !root.contains(editable)) return;

        event.preventDefault();
        event.stopPropagation();

        if (activeText && activeText !== editable) {
            activeText.removeAttribute('contenteditable');
            activeText.classList.remove('p26-editing-text');
        }

        activeText = editable;
        activeImage = null;
        activeVideo = null;
        activeText.setAttribute('contenteditable', 'true');
        activeText.setAttribute('spellcheck', 'true');
        activeText.classList.add('p26-editing-text');
        activeText.focus();

        const selection = window.getSelection();
        const range = document.createRange();
        range.selectNodeContents(activeText);
        selection.removeAllRanges();
        selection.addRange(range);
    }, true);

    root.addEventListener('input', function (event) {
        if (editMode && event.target.isContentEditable) {
            markChanged();
        }
    });

    root.addEventListener('keydown', function (event) {
        if (editMode && event.target.isContentEditable && event.key === 'Enter' &&
            !['P', 'LI', 'DIV'].includes(event.target.tagName)) {
            event.preventDefault();
            document.execCommand('insertLineBreak');
        }
    });

    save.addEventListener('click', async function () {
        if (save.disabled) return;

        save.disabled = true;
        status.textContent = 'Saving…';

        const clone = root.cloneNode(true);
        clearEditorState(clone);
        clone.querySelectorAll('[data-p26-temporary]').forEach((el) => el.remove());

        const form = new FormData();
        form.append('action', 'portfolio2k26_frontend_save');
        form.append('nonce', Portfolio2k26Editor.nonce);
        form.append('html', clone.innerHTML);

        try {
            const response = await fetch(Portfolio2k26Editor.ajaxUrl, {
                method: 'POST',
                credentials: 'same-origin',
                body: form
            });

            const result = await response.json();
            if (!response.ok || !result.success) {
                throw new Error(result.data?.message || Portfolio2k26Editor.error || 'Save failed');
            }

            status.textContent = Portfolio2k26Editor.saved || 'Portfolio changes saved.';
            save.disabled = true;

            if (activeText) {
                activeText.removeAttribute('contenteditable');
                activeText.classList.remove('p26-editing-text');
                activeText = null;
            }
            if (activeImage) {
                activeImage.classList.remove('p26-image-selected');
                activeImage = null;
            }
            if (activeVideo) {
                activeVideo.classList.remove('p26-video-selected');
                activeVideo = null;
            }
        } catch (error) {
            status.textContent = error.message || Portfolio2k26Editor.error || 'Unable to save. Please try again.';
            save.disabled = false;
        }
    });
})();
