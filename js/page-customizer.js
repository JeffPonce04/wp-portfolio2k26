(function () {
    'use strict';

    const config = window.Portfolio2k26PageSettings || {};
    const fields = config.fields || {};

    function setHeadingText(element, value) {
        const text = String(value == null ? '' : value);
        const accent = element.querySelector(':scope > span');
        const directText = Array.from(element.childNodes).find(node => node.nodeType === Node.TEXT_NODE);

        if (accent && text.trim().split(/\s+/).length > 1) {
            const words = text.trim().split(/\s+/);
            const accentText = words.pop();
            if (directText) directText.nodeValue = words.join(' ') + ' ';
            else element.insertBefore(document.createTextNode(words.join(' ') + ' '), accent);
            accent.textContent = accentText;
            return;
        }

        if (accent) accent.remove();
        if (directText) {
            directText.nodeValue = text;
            Array.from(element.childNodes).forEach(node => {
                if (node !== directText && node.nodeType === Node.TEXT_NODE) node.remove();
            });
        } else {
            element.textContent = text;
        }
    }

    function applyField(key, value) {
        const field = fields[key];
        if (!field || !field.selector) return;

        let elements;
        try { elements = document.querySelectorAll(field.selector); }
        catch (error) { return; }
        if (!elements.length) return;

        elements.forEach(element => {
            if (field.type === 'background') {
                if (value) {
                    element.style.backgroundImage = 'linear-gradient(rgba(0,0,0,.62), rgba(0,0,0,.62)), url(' + JSON.stringify(String(value)) + ')';
                    element.style.backgroundSize = 'cover';
                    element.style.backgroundPosition = 'center';
                    element.style.backgroundRepeat = 'no-repeat';
                } else {
                    element.style.removeProperty('background-image');
                    element.style.removeProperty('background-size');
                    element.style.removeProperty('background-position');
                    element.style.removeProperty('background-repeat');
                }
            } else if (field.type === 'heading') {
                setHeadingText(element, value);
            } else {
                element.textContent = String(value == null ? '' : value);
            }
            if (element.dataset && Object.prototype.hasOwnProperty.call(element.dataset, 'text')) {
                element.dataset.text = String(value == null ? '' : value);
            }
        });
    }

    Object.keys(fields).forEach(key => applyField(key, fields[key].value));

    // Text controls update instantly in the WordPress Customizer preview.
    // Media controls use the normal preview refresh so PHP can resolve attachment URLs.
    if (window.wp && window.wp.customize) {
        Object.keys(fields).forEach(key => {
            if (fields[key].type === 'background') return;
            window.wp.customize(key, function (setting) {
                setting.bind(value => applyField(key, value));
            });
        });
    }
})();