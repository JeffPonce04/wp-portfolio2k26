/* ============================================================
   ADVANCED ANIMATIONS & EFFECTS
   ============================================================ */

(() => {

      /* ============================================================
       1. TECHNOLOGY NETWORK NODES (Canvas Background)
       ============================================================ */
    const canvas = document.getElementById('particle-canvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let particles = [];
        let mouse = { x: null, y: null, radius: 200 };

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        window.addEventListener('mousemove', (e) => {
            mouse.x = e.x;
            mouse.y = e.y;
        });

        // Tech Node Particle Class
        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 2 + 1; // Slightly larger nodes
                this.speedX = Math.random() * 0.5 - 0.25;
                this.speedY = Math.random() * 0.5 - 0.25;
                this.opacity = Math.random() * 0.4 + 0.2;
                // Give some nodes a subtle glow
                this.isGlowing = Math.random() > 0.8; 
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;

                // Bounce off edges to keep them on screen
                if (this.x > canvas.width || this.x < 0) this.speedX *= -1;
                if (this.y > canvas.height || this.y < 0) this.speedY *= -1;

                // Mouse repulsion (Scanning effect)
                if (mouse.x && mouse.y) {
                    const dx = mouse.x - this.x;
                    const dy = mouse.y - this.y;
                    const distance = Math.sqrt(dx * dx + dy * dy);
                    if (distance < mouse.radius) {
                        const force = (mouse.radius - distance) / mouse.radius;
                        this.x -= dx * force * 0.03;
                        this.y -= dy * force * 0.03;
                    }
                }
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                
                if (this.isGlowing) {
                    ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity + 0.3})`;
                    ctx.shadowBlur = 10;
                    ctx.shadowColor = 'rgba(255, 255, 255, 0.5)';
                } else {
                    ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
                    ctx.shadowBlur = 0;
                }
                
                ctx.fill();
                ctx.shadowBlur = 0; // reset
            }
        }

        function initParticles() {
            // Density based on screen size
            const count = Math.min(Math.floor(window.innerWidth / 12), 120);
            particles = [];
            for (let i = 0; i < count; i++) {
                particles.push(new Particle());
            }
        }
        initParticles();
        window.addEventListener('resize', initParticles);

        // Draw connecting data lines
        function connectParticles() {
            for (let a = 0; a < particles.length; a++) {
                for (let b = a + 1; b < particles.length; b++) {
                    const dx = particles[a].x - particles[b].x;
                    const dy = particles[a].y - particles[b].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    // Connect if close enough
                    if (distance < 150) {
                        ctx.beginPath();
                        // Line fades out the further away it is
                        const opacity = 0.15 * (1 - distance / 150);
                        ctx.strokeStyle = `rgba(255, 255, 255, ${opacity})`;
                        ctx.lineWidth = 1;
                        ctx.moveTo(particles[a].x, particles[a].y);
                        ctx.lineTo(particles[b].x, particles[b].y);
                        ctx.stroke();
                    }
                }
            }
        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                p.update();
                p.draw();
            });
            connectParticles();
            requestAnimationFrame(animateParticles);
        }
        animateParticles();
    }

    /* ============================================================
       2. NAVBAR SCROLL EFFECT
       ============================================================ */
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => {
        if (nav) {
            if (window.scrollY > 100) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        }
    });

    /* ============================================================
       3. SCROLL REVEAL ANIMATIONS
       ============================================================ */
    const revealElements = document.querySelectorAll('.reveal-on-scroll');

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                revealObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    revealElements.forEach(el => revealObserver.observe(el));

    /* ============================================================
       4. AUTO-ASSIGN REVEAL CLASSES TO CARDS
       ============================================================ */
    const autoRevealSelectors = [
        '.team-card',
        '.project-card',
        '.service-card',
        '.stat-item',
        '.testimonial-card',
        '.blog-card',
        '.hobby-card',
        '.profile-skill-item',
        '.edu-highlight-pill'
    ];

    autoRevealSelectors.forEach(selector => {
        document.querySelectorAll(selector).forEach((el, index) => {
            if (!el.classList.contains('reveal-on-scroll') && !el.hasAttribute('data-aos')) {
                el.classList.add('reveal-on-scroll');
                el.style.transitionDelay = `${index * 0.1}s`;
                revealObserver.observe(el);
            }
        });
    });

    /* ============================================================
       5. 3D TILT EFFECT ON CARDS
       ============================================================ */
    function initTilt(selector) {
        document.querySelectorAll(selector).forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                const rotateX = (y - centerY) / 25;
                const rotateY = (centerX - x) / 25;

                const inner = card.querySelector('.card-inner');
                if (inner) {
                    inner.style.transform = `translateY(-10px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                }
            });

            card.addEventListener('mouseleave', () => {
                const inner = card.querySelector('.card-inner');
                if (inner) {
                    inner.style.transform = 'translateY(0) rotateX(0) rotateY(0)';
                }
            });
        });
    }

    initTilt('.team-card');

    /* ============================================================
       6. MAGNETIC BUTTON EFFECT
       ============================================================ */
    document.querySelectorAll('.btn, .nav-btn, .send-btn, .back-btn').forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;

            btn.style.transform = `translate(${x * 0.15}px, ${y * 0.15}px)`;
        });

        btn.addEventListener('mouseleave', () => {
            btn.style.transform = '';
        });
    });

    /* ============================================================
       7. GLOWING CURSOR EFFECT (subtle)
       ============================================================ */
    const cursorGlow = document.createElement('div');
    cursorGlow.style.cssText = `
        position: fixed;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,255,255,0.04), transparent 70%);
        pointer-events: none;
        z-index: 9998;
        transform: translate(-50%, -50%);
        transition: opacity 0.3s ease;
        opacity: 0;
    `;
    document.body.appendChild(cursorGlow);

    document.addEventListener('mousemove', (e) => {
        cursorGlow.style.left = e.clientX + 'px';
        cursorGlow.style.top = e.clientY + 'px';
        cursorGlow.style.opacity = '1';
    });

    document.addEventListener('mouseleave', () => {
        cursorGlow.style.opacity = '0';
    });

    /* ============================================================
       8. PAGE LOAD PROGRESS BAR
       ============================================================ */
    const progressBar = document.createElement('div');
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(90deg, #fff, #888);
        z-index: 10000;
        transition: width 0.3s ease;
        box-shadow: 0 0 10px rgba(255,255,255,0.5);
    `;
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        progressBar.style.width = scrollPercent + '%';
    });

    /* Removed input shifting effect to keep forms stable */

    /* ============================================================
       10. PARALLAX EFFECT ON HERO IMAGE
       ============================================================ */
    const heroImage = document.querySelector('.foreground-image-container');
    window.addEventListener('scroll', () => {
        if (heroImage && window.scrollY < window.innerHeight) {
            const scrollValue = window.scrollY;
            heroImage.style.transform = `translateY(${scrollValue * 0.15}px)`;
        }
    });

    /* ============================================================
       11. SECTION ENTRANCE ANIMATIONS
       ============================================================ */
    const sections = document.querySelectorAll('section');
    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.05 });

    sections.forEach(section => {
        if (!section.id.includes('profile') && section.id !== 'home' && !section.classList.contains('section-two')) {
            section.style.opacity = '0';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            sectionObserver.observe(section);
        }
    });

})();