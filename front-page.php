<?php get_header(); ?>
<?php
$portfolio_markup = <<<'PORTFOLIO_HTML'


    <!-- INTRO SCREEN -->
    <div class="intro-screen" id="introScreen">
        <div class="intro-content">
            <h1 class="intro-text">DEVELOPER <span>PORTFOLIO</span></h1>
            <div class="intro-line-container">
                <div class="intro-line"></div>
            </div>
        </div>
    </div>

    <div class="dev-portfolio-wrapper" id="home">
        <!-- NAVIGATION -->
        <nav class="portfolio-nav" id="mainNav">
            <div class="nav-logo">PERSONAL <span>PORTFOLIO</span></div>
            __PRIMARY_MENU__
            <div class="nav-cta">
                <a href="#contact" class="nav-btn">Let's Talk</a>
            </div>
        </nav>

        <!-- HERO SECTION -->
        <section class="hero-section">
            <div class="background-layer">
                <div class="hero-content">
                    <h1 class="hero-title">
                        <span class="title-small">WE BUILD THE</span>
                        <span class="title-large">FUTURE</span>
                    </h1>
                    <h2 class="hero-subtitle">ONE LINE OF CODE AT A TIME.</h2>
                    <p class="hero-desc">
                        "Driven by creativity, powered by technology, and united by innovation. We turn ideas into meaningful digital experiences."
                    </p>
                    <div class="hero-buttons">
                        <a href="#about" class="btn btn-primary">About us</a>
                        <a href="#contact" class="btn btn-secondary">Contact us</a>
                    </div>
                </div>

                <div class="marquee-container">
                    <div class="marquee-content">
                        <span>Driven by creativity, powered by technology, and united by innovation. We turn ideas into meaningful digital experiences. &nbsp;&nbsp;•&nbsp;&nbsp; </span>
                        <span>Driven by creativity, powered by technology, and united by innovation. We turn ideas into meaningful digital experiences. &nbsp;&nbsp;•&nbsp;&nbsp; </span>
                    </div>
                </div>
            </div>

            <div class="foreground-image-container" id="teamImage">
                <img src="__THEME_ASSET_0__" alt="Developer Team" class="hero-image">
            </div>
        </section>
    </div>

    <!-- JAVASCRIPT FOR ANIMATIONS -->
    

    <!-- ========== ABOUT US SECTION ========== -->
    <section class="about-section" id="about">
        <div class="bg-orbs">
            <span></span><span></span><span></span><span></span>
        </div>
        <div class="bg-aurora"></div>
        <div class="bg-grain"></div>

        <div class="container">
            <div class="section-header" data-aos="fade-up" data-aos-duration="1000">
                <span class="section-tag">/ our team</span>
                <h2 class="section-title">About <span>Us</span></h2>
                <div class="title-line"></div>
                <p class="section-subtitle">Four minds. One vision. Black & white clarity.</p>
            </div>

            <div class="team-grid">
                <!-- 1. Maria -->
                <div class="team-card" data-aos="fade-up" data-aos-delay="0" data-aos-duration="800">
                    <div class="card-inner">
                        <div class="card-image" data-member="maria">
                            <img src="__THEME_ASSET_1__" alt="Maria Blanquera">
                            <div class="image-overlay"></div>
                        </div>
                        <div class="card-content">
                            <h3 class="member-name">Maria Blanquera</h3>
                            <p class="member-role">PROJECT MANAGER</p>
                            <p class="member-desc">Leads the team, manages project tasks, and ensures that all activities are completed according to the project goals and deadlines.</p>
                            <div class="view-skills-label" data-member="maria">
                                <i class="fas fa-chart-line"></i> Skills &amp; Expertise
                            </div>
                            <div class="social-mini">
                                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="#" aria-label="Telegram"><i class="fab fa-telegram-plane"></i></a>
                                <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Jefferson -->
                <div class="team-card" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
                    <div class="card-inner">
                        <div class="card-image" data-member="jefferson">
                            <img src="__THEME_ASSET_2__" alt="Jefferson Ponce">
                            <div class="image-overlay"></div>
                        </div>
                        <div class="card-content">
                            <h3 class="member-name">Jefferson Ponce</h3>
                            <p class="member-role">PROGRAMMER</p>
                            <p class="member-desc">Responsible for designing, coding, and developing the software to ensure that all system features function properly.</p>
                            <div class="view-skills-label" data-member="jefferson">
                                <i class="fas fa-chart-line"></i> Skills &amp; Expertise
                            </div>
                            <div class="social-mini">
                                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="#" aria-label="Telegram"><i class="fab fa-telegram-plane"></i></a>
                                <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Geoffrey -->
                <div class="team-card" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800">
                    <div class="card-inner">
                        <div class="card-image" data-member="geo">
                            <img src="__THEME_ASSET_3__" alt="Geoffrey Bermudez">
                            <div class="image-overlay"></div>
                        </div>
                        <div class="card-content">
                            <h3 class="member-name">Geoffrey Bermudez</h3>
                            <p class="member-role">ANALYST</p>
                            <p class="member-desc">Gathers and evaluates information to identify user requirements and ensure that the system effectively addresses the project's objectives.</p>
                            <div class="view-skills-label" data-member="geo">
                                <i class="fas fa-chart-line"></i> Skills &amp; Expertise
                            </div>
                            <div class="social-mini">
                                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="#" aria-label="Telegram"><i class="fab fa-telegram-plane"></i></a>
                                <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Adriane -->
                <div class="team-card" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
                    <div class="card-inner">
                        <div class="card-image" data-member="adriane">
                            <img src="__THEME_ASSET_4__" alt="Adriane Manggay">
                            <div class="image-overlay"></div>
                        </div>
                        <div class="card-content">
                            <h3 class="member-name">Adriane Manggay</h3>
                            <p class="member-role">TECHNICAL WRITER</p>
                            <p class="member-desc">Prepares clear and accurate technical documentation, user manuals, and guides to help users understand and operate the system.</p>
                            <div class="view-skills-label" data-member="adriane">
                                <i class="fas fa-chart-line"></i> Skills &amp; Expertise
                            </div>
                            <div class="social-mini">
                                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="#" aria-label="Telegram"><i class="fab fa-telegram-plane"></i></a>
                                <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-footer" data-aos="fade-up" data-aos-delay="200">
                <span class="footer-quote">“Design is intelligence made visible.”</span>
            </div>
        </div>
    </section>

    <!-- ========== EDUCATION SECTION ========== -->
    <section class="education-section" id="education">
        <div class="edu-bg-grid"></div>
        <div class="edu-bg-glow"></div>

        <div class="edu-container">
            <div class="edu-header" data-aos="fade-up" data-aos-duration="1000">
                <h2 class="edu-title">My <span>Education</span></h2>
                <div class="edu-title-line"></div>
                <p class="edu-subtitle">Where the journey of innovation began.</p>
            </div>

            <div class="edu-main-card" data-aos="fade-up" data-aos-duration="900">
                <div class="edu-logos-side">
                    <div class="edu-logo-box" data-aos="zoom-in" data-aos-delay="100">
                        <a href="https://www.facebook.com/profile.php?id=100057099204299" target="_blank" rel="noopener noreferrer" class="edu-logo-link" title="Visit OCC Facebook Page">
                            <div class="edu-logo-inner">
                                <img src="__THEME_ASSET_5__" alt="School Logo" class="edu-logo school-logo" style="filter: none;">
                                <div class="edu-logo-visit"><i class="fas fa-external-link-alt"></i></div>
                            </div>
                        </a>
                        <p class="edu-logo-label">OCC</p>
                    </div>

                    <div class="edu-logo-connector"><span></span></div>

                    <div class="edu-logo-box" data-aos="zoom-in" data-aos-delay="250">
                        <a href="https://www.facebook.com/occbsitdepartment" target="_blank" rel="noopener noreferrer" class="edu-logo-link" title="Visit IT Department Facebook Page">
                            <div class="edu-logo-inner">
                                <img src="__THEME_ASSET_6__" alt="IT Department Logo" class="edu-logo it-logo" style="filter: none;">
                                <div class="edu-logo-visit"><i class="fas fa-external-link-alt"></i></div>
                            </div>
                        </a>
                        <p class="edu-logo-label">IT Department</p>
                    </div>
                </div>

                <div class="edu-content-side" data-aos="fade-left" data-aos-delay="200">
                    <div class="edu-school-name">
                        <i class="fas fa-university"></i>
                        <span>Opol Community College</span>
                    </div>
                    <h3 class="edu-degree">Bachelor of Science in Information Technology</h3>
                    <p class="edu-period">
                        <i class="fas fa-calendar-alt"></i> 2023 — 2027 &nbsp;|&nbsp;
                        <i class="fas fa-map-marker-alt"></i> Opol Misamis Oriental, Philippines
                    </p>
                    <div class="edu-divider"></div>
                    <p class="edu-description">
                        The <strong>Information Technology Department</strong> is a hub of innovation where students
                        learn to design, build, and maintain the digital systems of tomorrow. Our curriculum blends
                        theoretical foundations with hands-on practice in programming, networking, database management,
                        and modern software development.
                    </p>
                    <p class="edu-description">
                        Through capstone projects, industry partnerships, and real-world simulations, the department
                        equips students with the technical expertise and critical thinking needed to thrive in the
                        fast-paced world of technology. We believe in <em>learning by building</em> — every line of code
                        is a step toward shaping the future.
                    </p>
                    <div class="edu-highlights">
                        <div class="edu-highlight-pill"><i class="fas fa-code"></i><span>Programming</span></div>
                        <div class="edu-highlight-pill"><i class="fas fa-network-wired"></i><span>Networking</span></div>
                        <div class="edu-highlight-pill"><i class="fas fa-database"></i><span>Database</span></div>
                        <div class="edu-highlight-pill"><i class="fas fa-shield-alt"></i><span>Cybersecurity</span></div>
                        <div class="edu-highlight-pill"><i class="fas fa-mobile-alt"></i><span>Web & Mobile</span></div>
                    </div>
                    <div class="edu-stats">
                        <div class="edu-stat"><span class="edu-stat-number" data-count="4">0</span><span class="edu-stat-label">Years</span></div>
                        <div class="edu-stat"><span class="edu-stat-number" data-count="40">0</span><span class="edu-stat-label">Courses</span></div>
                        <div class="edu-stat"><span class="edu-stat-number" data-count="15">0</span><span class="edu-stat-label">Projects</span></div>
                        <div class="edu-stat"><span class="edu-stat-number" data-count="3">0</span><span class="edu-stat-label">Awards</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== PROJECTS SECTION ========== -->
    <section class="projects-section" id="projects">
        <div class="section-container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-tag">/ portfolio</span>
                <h2 class="section-title">Featured <span>Projects</span></h2>
                <div class="title-line"></div>
                <p class="section-subtitle">Explore our latest works built with modern tech.</p>
            </div>

            <div class="projects-grid">
                <!-- Project 1: Java -->
                <div class="project-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="project-image">
                        <img src="__THEME_ASSET_7__" alt="Java Project" style="filter: none;">
                        <div class="project-overlay">
                            <a href="javascript:void(0)" class="project-link" data-project="inventory-management-system"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <div class="project-info">
                        <span class="project-lang"><i class="fab fa-java"></i> Java</span>
                        <h3 class="project-title">Inventory Management System</h3>
                        <p class="project-desc">A robust desktop application for managing stock, suppliers, and sales built with JavaFX and MySQL.</p>
                    </div>
                </div>

                <!-- Project 2: Python -->
                <div class="project-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="project-image">
                        <img src="__THEME_ASSET_8__" alt="Python Project" style="filter: none;">
                        <div class="project-overlay">
                            <a href="javascript:void(0)" class="project-link" data-project="ai-chatbot-assistant"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <div class="project-info">
                        <span class="project-lang"><i class="fab fa-python"></i> Python</span>
                        <h3 class="project-title">AI Chatbot Assistant</h3>
                        <p class="project-desc">An intelligent chatbot using Natural Language Processing to answer customer queries automatically.</p>
                    </div>
                </div>

                <!-- Project 3: HTML/CSS/JS -->
                <div class="project-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="project-image">
                        <img src="__THEME_ASSET_9__" alt="Web Project" style="filter: none;">
                        <div class="project-overlay">
                            <a href="javascript:void(0)" class="project-link" data-project="e-commerce-landing-page"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <div class="project-info">
                        <span class="project-lang"><i class="fab fa-html5"></i> HTML/CSS/JS</span>
                        <h3 class="project-title">E-Commerce Landing Page</h3>
                        <p class="project-desc">A fully responsive and interactive landing page for a modern fashion brand.</p>
                    </div>
                </div>

                <!-- Project 4: React JS -->
                <div class="project-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="project-image">
                        <img src="__THEME_ASSET_10__" alt="React Project" style="filter: none;">
                        <div class="project-overlay">
                            <a href="javascript:void(0)" class="project-link" data-project="task-management-dashboard"><i class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div>
                    <div class="project-info">
                        <span class="project-lang"><i class="fab fa-react"></i> React JS</span>
                        <h3 class="project-title">Task Management Dashboard</h3>
                        <p class="project-desc">A dynamic single-page application for tracking tasks with drag-and-drop functionality.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== SERVICES SECTION ========== -->
    <section class="services-section" id="services">
        <div class="section-container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-tag">/ what we do</span>
                <h2 class="section-title">Our <span>Services</span></h2>
                <div class="title-line"></div>
                <p class="section-subtitle">We deliver high-quality solutions across multiple platforms.</p>
            </div>

            <div class="services-grid">
                <div class="service-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="service-icon"><i class="fas fa-globe"></i></div>
                    <h3 class="service-title">Web Development</h3>
                    <p class="service-desc">Building fast, responsive, and scalable web applications using modern frameworks.</p>
                    <div class="service-langs">
                        <span>HTML/CSS</span><span>JavaScript</span><span>React</span><span>Node.js</span><span>PHP</span>
                    </div>
                </div>

                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-icon"><i class="fas fa-mobile-alt"></i></div>
                    <h3 class="service-title">Mobile Development</h3>
                    <p class="service-desc">Creating cross-platform mobile apps that deliver a seamless native experience.</p>
                    <div class="service-langs">
                        <span>React Native</span><span>Flutter</span><span>Swift</span><span>Kotlin</span>
                    </div>
                </div>

                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-icon"><i class="fas fa-gamepad"></i></div>
                    <h3 class="service-title">Game Development</h3>
                    <p class="service-desc">Designing and developing engaging 2D and 3D games for various platforms.</p>
                    <div class="service-langs">
                        <span>Unity</span><span>C#</span><span>C++</span><span>Godot</span>
                    </div>
                </div>

                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-icon"><i class="fas fa-server"></i></div>
                    <h3 class="service-title">Backend & API</h3>
                    <p class="service-desc">Building secure, high-performance server-side logic and RESTful APIs.</p>
                    <div class="service-langs">
                        <span>Python</span><span>Java</span><span>Node.js</span><span>MySQL</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== ACHIEVEMENTS & STATISTICS ========== -->
    <section class="achievements-section" id="achievements">
        <div class="section-container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-tag">/ milestones</span>
                <h2 class="section-title">Achievements & <span>Statistics</span></h2>
                <div class="title-line"></div>
                <p class="section-subtitle">Numbers that reflect our dedication and hard work.</p>
            </div>

            <div class="stats-grid">
                <div class="stat-item" data-aos="zoom-in" data-aos-delay="0">
                    <div class="stat-icon"><i class="fas fa-project-diagram"></i></div>
                    <h3 class="stat-number" data-count="120">0</h3>
                    <p class="stat-label">Projects Completed</p>
                </div>
                <div class="stat-item" data-aos="zoom-in" data-aos-delay="100">
                    <div class="stat-icon"><i class="fas fa-smile"></i></div>
                    <h3 class="stat-number" data-count="85">0</h3>
                    <p class="stat-label">Happy Clients</p>
                </div>
                <div class="stat-item" data-aos="zoom-in" data-aos-delay="200">
                    <div class="stat-icon"><i class="fas fa-award"></i></div>
                    <h3 class="stat-number" data-count="15">0</h3>
                    <p class="stat-label">Awards Won</p>
                </div>
                <div class="stat-item" data-aos="zoom-in" data-aos-delay="300">
                    <div class="stat-icon"><i class="fas fa-code"></i></div>
                    <h3 class="stat-number" data-count="500000" data-suffix="+">0</h3>
                    <p class="stat-label">Lines of Code</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== TESTIMONIALS SECTION ========== -->
    <section class="testimonials-section" id="testimonials">
        <div class="section-container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-tag">/ feedback</span>
                <h2 class="section-title">Client <span>Testimonials</span></h2>
                <div class="title-line"></div>
                <p class="section-subtitle">What people say about working with us.</p>
            </div>

            <div class="testimonials-grid">
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <p class="testimonial-text">"The team delivered our e-commerce platform ahead of schedule. Their attention to detail and coding standards are top-notch."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar"><i class="fas fa-user"></i></div>
                        <div>
                            <h4 class="author-name">Sarah Jenkins</h4>
                            <p class="author-role">CEO, TrendStore</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <p class="testimonial-text">"Working with Jefferson and his team was a breeze. They understood our vision and built a mobile app that exceeded our expectations."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar"><i class="fas fa-user"></i></div>
                        <div>
                            <h4 class="author-name">Mark Villanueva</h4>
                            <p class="author-role">Founder, FoodieApp</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                    <p class="testimonial-text">"Their technical documentation and testing process are incredibly thorough. We felt confident from start to finish."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar"><i class="fas fa-user"></i></div>
                        <div>
                            <h4 class="author-name">Emily Chen</h4>
                            <p class="author-role">CTO, InnovateLab</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== BLOG / ARTICLES SECTION ========== -->
    <section class="blog-section" id="blog">
        <div class="section-container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-tag">/ insights</span>
                <h2 class="section-title">Latest <span>Articles</span></h2>
                <div class="title-line"></div>
                <p class="section-subtitle">Thoughts, tutorials, and news from our team.</p>
            </div>

            <div class="blog-grid">
                <article class="blog-card" data-aos="fade-up" data-aos-delay="0">
                    <div class="blog-image">
                        <img src="__THEME_ASSET_11__" alt="Blog Post">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="fas fa-calendar"></i> May 15, 2025</span>
                            <span><i class="fas fa-tag"></i> Development</span>
                        </div>
                        <h3 class="blog-title">Why React Remains the Top Choice for Frontend in 2025</h3>
                        <p class="blog-desc">Exploring the new features and ecosystem updates that keep React at the forefront of web development.</p>
                        <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="blog-image">
                        <img src="__THEME_ASSET_12__" alt="Blog Post">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="fas fa-calendar"></i> April 28, 2025</span>
                            <span><i class="fas fa-tag"></i> Design</span>
                        </div>
                        <h3 class="blog-title">The Power of Minimalist UI in Modern Web Applications</h3>
                        <p class="blog-desc">How simplifying designs can drastically improve user experience and conversion rates.</p>
                        <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="blog-image">
                        <img src="__THEME_ASSET_13__" alt="Blog Post">
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="fas fa-calendar"></i> April 10, 2025</span>
                            <span><i class="fas fa-tag"></i> Python</span>
                        </div>
                        <h3 class="blog-title">Building Your First AI Model with Python: A Beginner's Guide</h3>
                        <p class="blog-desc">A step-by-step tutorial on leveraging Python libraries to create a simple predictive model.</p>
                        <a href="#" class="blog-read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ========== SKILLS MODAL ========== -->
    <div class="skills-modal-overlay" id="skillsModal">
        <div class="skills-modal" role="dialog" aria-modal="true" aria-labelledby="modalName">
            <button class="skills-modal-close" id="skillsModalClose" aria-label="Close modal">
                <i class="fas fa-times"></i>
            </button>

            <div class="skills-modal-header">
                <img src="" alt="" class="skills-modal-photo" id="modalPhoto">
                <div>
                    <h2 class="skills-modal-name" id="modalName">—</h2>
                    <p class="skills-modal-role" id="modalRole">—</p>
                </div>
            </div>

            <p class="skills-modal-label">Skills &amp; Expertise</p>
            <div id="modalSkills"></div>
            <div class="skill-tags" id="modalTags"></div>
        </div>
    </div>

    <!-- ========== PROJECT DETAILS MODAL (WITH SLIDER) ========== -->
    <div class="project-modal-overlay" id="projectModal">
        <div class="project-modal">
            <button class="project-modal-close" id="projectModalClose" aria-label="Close modal">
                <i class="fas fa-times"></i>
            </button>

            <!-- SLIDER CONTAINER -->
            <div class="project-slider-container">
                <div class="project-slider-track" id="pmTrack">
                    <!-- Images injected here -->
                </div>
                <button class="slider-btn prev" id="pmPrev"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-btn next" id="pmNext"><i class="fas fa-chevron-right"></i></button>
                <div class="slider-dots" id="pmDots"></div>
            </div>
            
            <div class="project-modal-header-info">
                <span class="project-lang" id="pmLang"><i class="fab fa-java"></i> Java</span>
                <h2 class="project-modal-title" id="pmTitle">Project Title</h2>
            </div>

            <div class="project-modal-body">
                <p class="project-modal-desc" id="pmDesc">Project description goes here...</p>
                
                <div class="project-modal-features">
                    <h3>System Features</h3>
                    <ul id="pmFeatures">
                        <!-- Features injected here -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <section class="section-two" id="contact">
        <div class="container_contact">
            <h2>FOLLOW ON FACEBOOK</h2>
            <span>@Jefferson_Ponce</span>
            <div class="insta-imgs">
                <div><img src="__THEME_ASSET_14__" style="filter: none;"><div class="icon-overlay flex"></div></div>
                <div><img src="__THEME_ASSET_15__" style="filter: none;"><div class="icon-overlay flex"></div></div>
                <div><img src="__THEME_ASSET_16__" style="filter: none;"><div class="icon-overlay flex"></div></div>
                <div><img src="__THEME_ASSET_17__" style="filter: none;"><div class="icon-overlay flex"></div></div>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="title reveal">
            <h2 class="section-title">Contact Me</h2>
        </div>
        <div class="content">
            <div class="row">
                <div class="card reveal">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="info"><h3>Address</h3><span>El Salvador City</span></div>
                </div>
                <div class="card reveal">
                    <div class="contact-icon"><i class="fas fa-phone"></i></div>
                    <div class="info"><h3>Phone</h3><span>+63 970 898 6628</span></div>
                </div>
                <div class="card reveal">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div class="info"><h3>Email Address</h3><span>cmponce90@gmail.com</span></div>
                </div>
                <div class="card reveal">
                    <div class="contact-icon"><i class='fab fa-facebook-messenger'></i></div>
                    <div class="info"><h3>Messenger</h3><span>Jefferson Ponce</span></div>
                </div>
            </div>
            <div class="row">
                <form class="contact-form reveal" method="post" action="__ADMIN_POST_URL__">
                    <h3>Send Message</h3>
                    <input type="hidden" name="action" value="my_portfolio_contact">
                    __CONTACT_NONCE_FIELD__
                    <div class="input-box"><input type="text" name="name" placeholder="Name" required></div>
                    <div class="input-box"><input type="email" name="email" placeholder="Email" required></div>
                    <div class="input-box"><textarea rows="8" name="message" placeholder="Message" required></textarea></div>
                    <div class="input-box"><input type="submit" class="send-btn" value="Send"></div>
                </form>
            </div>
        </div>
    </section>

    <footer class="footer">
        <span class="footer-title">__FOOTER_NAME__</span>
        <p>Copyright @2025 <a href="#">Final Project</a>. <br> All Rights Reserved.</p>
    </footer>

    
    

    <!-- ========== JAVASCRIPT FOR MODALS, SLIDER & COUNTERS ========== -->
    

PORTFOLIO_HTML;
$portfolio_markup = str_replace('__PRIMARY_MENU__', wp_nav_menu(['theme_location'=>'primary','container'=>false,'menu_class'=>'nav-links','echo'=>false,'fallback_cb'=>function(){ return '<ul class="nav-links"><li><a href="#home">Home</a></li><li><a href="#about">About</a></li><li><a href="#education">Education</a></li><li><a href="#projects">Projects</a></li><li><a href="#services">Services</a></li><li><a href="#achievements">Achievements</a></li><li><a href="#testimonials">Testimonials</a></li><li><a href="#blog">Blog</a></li></ul>'; }]), $portfolio_markup);
$portfolio_markup = str_replace('__ADMIN_POST_URL__', esc_url(admin_url('admin-post.php')), $portfolio_markup);
$portfolio_markup = str_replace('__CONTACT_NONCE_FIELD__', wp_nonce_field('my_portfolio_contact', 'contact_nonce', true, false), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_0__', esc_url(get_theme_file_uri('/assets/images/grouoPhoto.png')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_1__', esc_url(get_theme_file_uri('/assets/images/maria.png')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_2__', esc_url(get_theme_file_uri('/assets/images/jefferson.png')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_3__', esc_url(get_theme_file_uri('/assets/images/geo.png')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_4__', esc_url(get_theme_file_uri('/assets/images/adriane.png')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_5__', esc_url(get_theme_file_uri('/assets/images/occ.jpg')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_6__', esc_url(get_theme_file_uri('/assets/images/it.avif')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_7__', esc_url(get_theme_file_uri('/assets/images/java.jpg')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_8__', esc_url(get_theme_file_uri('/assets/images/python.jpg')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_9__', esc_url(get_theme_file_uri('/assets/images/html.jpg')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_10__', esc_url(get_theme_file_uri('/assets/images/react.jpg')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_11__', esc_url(get_theme_file_uri('/assets/images/blog1.jpg')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_12__', esc_url(get_theme_file_uri('/assets/images/blog2.jpg')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_13__', esc_url(get_theme_file_uri('/assets/images/blog3.jpg')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_14__', esc_url(get_theme_file_uri('/assets/images/contact1.png')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_15__', esc_url(get_theme_file_uri('/assets/images/contact2.png')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_16__', esc_url(get_theme_file_uri('/assets/images/contact3.png')), $portfolio_markup);
$portfolio_markup = str_replace('__THEME_ASSET_17__', esc_url(get_theme_file_uri('/assets/images/contact4.png')), $portfolio_markup);

// Dashboard-managed content overrides.
$mp_text_overrides = [
    'WE BUILD THE' => esc_html(mp_editor_get('hero_small')),
    'FUTURE' => esc_html(mp_editor_get('hero_large')),
    'ONE LINE OF CODE AT A TIME.' => esc_html(mp_editor_get('hero_subtitle')),
    '"Driven by creativity, powered by technology, and united by innovation. We turn ideas into meaningful digital experiences."' => esc_html(mp_editor_get('hero_description')),
    'Driven by creativity, powered by technology, and united by innovation. We turn ideas into meaningful digital experiences.' => esc_html(mp_editor_get('hero_marquee')),
    'About us' => esc_html(mp_editor_get('hero_button1')),
    'Contact us' => esc_html(mp_editor_get('hero_button2')),
    '/ our team' => esc_html(mp_editor_get('about_tag')),
    'Four minds. One vision. Black & white clarity.' => esc_html(mp_editor_get('about_subtitle')),
    '“Design is intelligence made visible.”' => esc_html(mp_editor_get('about_quote')),
    'Maria Blanquera' => esc_html(mp_editor_get('team_1_name')),
    'PROJECT MANAGER' => esc_html(mp_editor_get('team_1_role')),
    'Leads the team, manages project tasks, and ensures that all activities are completed according to the project goals and deadlines.' => esc_html(mp_editor_get('team_1_desc')),
    'Jefferson Ponce' => esc_html(mp_editor_get('team_2_name')),
    'PROGRAMMER' => esc_html(mp_editor_get('team_2_role')),
    'Responsible for designing, coding, and developing the software to ensure that all system features function properly.' => esc_html(mp_editor_get('team_2_desc')),
    'Geoffrey Bermudez' => esc_html(mp_editor_get('team_3_name')),
    'ANALYST' => esc_html(mp_editor_get('team_3_role')),
    "Gathers and evaluates information to identify user requirements and ensure that the system effectively addresses the project's objectives." => esc_html(mp_editor_get('team_3_desc')),
    'Adriane Manggay' => esc_html(mp_editor_get('team_4_name')),
    'TECHNICAL WRITER' => esc_html(mp_editor_get('team_4_role')),
    'Prepares clear and accurate technical documentation, user manuals, and guides to help users understand and operate the system.' => esc_html(mp_editor_get('team_4_desc')),
    'My <span>Education</span>' => esc_html(mp_editor_get('education_title')),
    'Where the journey of innovation began.' => esc_html(mp_editor_get('education_subtitle')),
    'Opol Community College' => esc_html(mp_editor_get('education_school')),
    'Bachelor of Science in Information Technology' => esc_html(mp_editor_get('education_degree')),
    '2023 — 2027' => esc_html(mp_editor_get('education_period')),
    'Opol Misamis Oriental, Philippines' => esc_html(mp_editor_get('education_location')),
    'The <strong>Information Technology Department</strong> is a hub of innovation where students\\n                        learn to design, build, and maintain the digital systems of tomorrow. Our curriculum blends\\n                        theoretical foundations with hands-on practice in programming, networking, database management,\\n                        and modern software development.' => esc_html(mp_editor_get('education_description1')),
    'Through capstone projects, industry partnerships, and real-world simulations, the department\\n                        equips students with the technical expertise and critical thinking needed to thrive in the\\n                        fast-paced world of technology. We believe in <em>learning by building</em> — every line of code\\n                        is a step toward shaping the future.' => esc_html(mp_editor_get('education_description2')),
    'Inventory Management System' => esc_html(mp_editor_get('project_1_title')),
    'A robust desktop application for managing stock, suppliers, and sales built with JavaFX and MySQL.' => esc_html(mp_editor_get('project_1_desc')),
    'AI Chatbot Assistant' => esc_html(mp_editor_get('project_2_title')),
    'An intelligent chatbot using Natural Language Processing to answer customer queries automatically.' => esc_html(mp_editor_get('project_2_desc')),
    'E-Commerce Landing Page' => esc_html(mp_editor_get('project_3_title')),
    'A fully responsive and interactive landing page for a modern fashion brand.' => esc_html(mp_editor_get('project_3_desc')),
    'Task Management Dashboard' => esc_html(mp_editor_get('project_4_title')),
    'A dynamic single-page application for tracking tasks with drag-and-drop functionality.' => esc_html(mp_editor_get('project_4_desc')),
    'Web Development' => esc_html(mp_editor_get('service_1_title')),
    'Building fast, responsive, and scalable web applications using modern frameworks.' => esc_html(mp_editor_get('service_1_desc')),
    'Mobile Development' => esc_html(mp_editor_get('service_2_title')),
    'Creating cross-platform mobile apps that deliver a seamless native experience.' => esc_html(mp_editor_get('service_2_desc')),
    'Game Development' => esc_html(mp_editor_get('service_3_title')),
    'Designing and developing engaging 2D and 3D games for various platforms.' => esc_html(mp_editor_get('service_3_desc')),
    'Backend & API' => esc_html(mp_editor_get('service_4_title')),
    'Building secure, high-performance server-side logic and RESTful APIs.' => esc_html(mp_editor_get('service_4_desc')),
    'Projects Completed' => esc_html(mp_editor_get('stat_1_label')),
    'Happy Clients' => esc_html(mp_editor_get('stat_2_label')),
    'Awards Won' => esc_html(mp_editor_get('stat_3_label')),
    'Lines of Code' => esc_html(mp_editor_get('stat_4_label')),
    'The team delivered our e-commerce platform ahead of schedule. Their attention to detail and coding standards are top-notch.' => esc_html(mp_editor_get('testimonial_1_quote')),
    'Sarah Jenkins' => esc_html(mp_editor_get('testimonial_1_author')),
    'CEO, TrendStore' => esc_html(mp_editor_get('testimonial_1_role')),
    'Working with Jefferson and his team was a breeze. They understood our vision and built a mobile app that exceeded our expectations.' => esc_html(mp_editor_get('testimonial_2_quote')),
    'Mark Villanueva' => esc_html(mp_editor_get('testimonial_2_author')),
    'Founder, FoodieApp' => esc_html(mp_editor_get('testimonial_2_role')),
    'Their technical documentation and testing process are incredibly thorough. We felt confident from start to finish.' => esc_html(mp_editor_get('testimonial_3_quote')),
    'Emily Chen' => esc_html(mp_editor_get('testimonial_3_author')),
    'CTO, InnovateLab' => esc_html(mp_editor_get('testimonial_3_role')),
    'Why React Remains the Top Choice for Frontend in 2025' => esc_html(mp_editor_get('blog_1_title')),
    'Exploring the new features and ecosystem updates that keep React at the forefront of web development.' => esc_html(mp_editor_get('blog_1_desc')),
    'The Power of Minimalist UI in Modern Web Applications' => esc_html(mp_editor_get('blog_2_title')),
    'How simplifying designs can drastically improve user experience and conversion rates.' => esc_html(mp_editor_get('blog_2_desc')),
    "Building Your First AI Model with Python: A Beginner's Guide" => esc_html(mp_editor_get('blog_3_title')),
    'A step-by-step tutorial on leveraging Python libraries to create a simple predictive model.' => esc_html(mp_editor_get('blog_3_desc')),
    'El Salvador City' => esc_html(mp_editor_get('contact_address')),
    '+63 970 898 6628' => esc_html(mp_editor_get('contact_phone')),
    'cmponce90@gmail.com' => esc_html(mp_editor_get('contact_email')),
    'Copyright @2025' => esc_html(mp_editor_get('footer_copyright')),
    'Final Project' => esc_html(mp_editor_get('footer_project_link')),
    'All Rights Reserved.' => esc_html(mp_editor_get('footer_rights')),
];
foreach ($mp_text_overrides as $original => $replacement) { $portfolio_markup = str_replace($original, $replacement, $portfolio_markup); }


$mp_image_overrides = [
    '__THEME_ASSET_0__' => mp_editor_get('hero_team_image') ?: get_theme_file_uri('/assets/images/grouoPhoto.png'),
    '__THEME_ASSET_1__' => mp_editor_get('team_1_photo') ?: get_theme_file_uri('/assets/images/maria.png'),
    '__THEME_ASSET_2__' => mp_editor_get('team_2_photo') ?: get_theme_file_uri('/assets/images/jefferson.png'),
    '__THEME_ASSET_3__' => mp_editor_get('team_3_photo') ?: get_theme_file_uri('/assets/images/geo.png'),
    '__THEME_ASSET_4__' => mp_editor_get('team_4_photo') ?: get_theme_file_uri('/assets/images/adriane.png'),
    '__THEME_ASSET_5__' => mp_editor_get('education_logo1') ?: get_theme_file_uri('/assets/images/occ.jpg'),
    '__THEME_ASSET_6__' => mp_editor_get('education_logo2') ?: get_theme_file_uri('/assets/images/it.avif'),
    '__THEME_ASSET_7__' => mp_editor_get('project_1_image') ?: get_theme_file_uri('/assets/images/java.jpg'),
    '__THEME_ASSET_8__' => mp_editor_get('project_2_image') ?: get_theme_file_uri('/assets/images/python.jpg'),
    '__THEME_ASSET_9__' => mp_editor_get('project_3_image') ?: get_theme_file_uri('/assets/images/html.jpg'),
    '__THEME_ASSET_10__' => mp_editor_get('project_4_image') ?: get_theme_file_uri('/assets/images/react.jpg'),
    '__THEME_ASSET_11__' => mp_editor_get('blog_1_image') ?: get_theme_file_uri('/assets/images/blog1.jpg'),
    '__THEME_ASSET_12__' => mp_editor_get('blog_2_image') ?: get_theme_file_uri('/assets/images/blog2.jpg'),
    '__THEME_ASSET_13__' => mp_editor_get('blog_3_image') ?: get_theme_file_uri('/assets/images/blog3.jpg'),
    '__THEME_ASSET_14__' => mp_editor_get('contact_gallery_1') ?: get_theme_file_uri('/assets/images/contact1.png'),
    '__THEME_ASSET_15__' => mp_editor_get('contact_gallery_2') ?: get_theme_file_uri('/assets/images/contact2.png'),
    '__THEME_ASSET_16__' => mp_editor_get('contact_gallery_3') ?: get_theme_file_uri('/assets/images/contact3.png'),
    '__THEME_ASSET_17__' => mp_editor_get('contact_gallery_4') ?: get_theme_file_uri('/assets/images/contact4.png'),
];
foreach ($mp_image_overrides as $token => $url) { $portfolio_markup = str_replace($token, esc_url($url), $portfolio_markup); }

$portfolio_markup = str_replace('Contact Me', esc_html(mp_editor_get('contact_title')), $portfolio_markup);
$portfolio_markup = str_replace('Jefferson Ponce', esc_html(mp_editor_get('footer_name')), $portfolio_markup);
$portfolio_markup = str_replace('Maria Blanquera', esc_html(mp_editor_get('team_1_name')), $portfolio_markup);


$mp_more_overrides = [
    'Featured' => esc_html(mp_editor_get('projects_heading')),
    '/ portfolio' => esc_html(mp_editor_get('projects_tag')),
    'Explore our latest works built with modern tech.' => esc_html(mp_editor_get('projects_subtitle')),
    '/ what we do' => esc_html(mp_editor_get('services_tag')),
    'We deliver high-quality solutions across multiple platforms.' => esc_html(mp_editor_get('services_subtitle')),
    '/ milestones' => esc_html(mp_editor_get('achievements_tag')),
    'Numbers that reflect our dedication and hard work.' => esc_html(mp_editor_get('achievements_subtitle')),
    '/ feedback' => esc_html(mp_editor_get('testimonials_tag')),
    'What people say about working with us.' => esc_html(mp_editor_get('testimonials_subtitle')),
    '/ insights' => esc_html(mp_editor_get('blog_tag')),
    'Thoughts, tutorials, and news from our team.' => esc_html(mp_editor_get('blog_subtitle')),
    'FOLLOW ON FACEBOOK' => esc_html(mp_editor_get('facebook_heading')),
    '@Jefferson_Ponce' => esc_html(mp_editor_get('facebook_handle')),
]; foreach ($mp_more_overrides as $original=>$replacement) { $portfolio_markup=str_replace($original,$replacement,$portfolio_markup); }

$portfolio_markup = str_replace('Featured <span>Projects</span>', esc_html(mp_editor_get('projects_heading')), $portfolio_markup);
$portfolio_markup = str_replace('Our <span>Services</span>', esc_html(mp_editor_get('services_heading')), $portfolio_markup);
$portfolio_markup = str_replace('Achievements & <span>Statistics</span>', esc_html(mp_editor_get('achievements_heading')), $portfolio_markup);
$portfolio_markup = str_replace('Client <span>Testimonials</span>', esc_html(mp_editor_get('testimonials_heading')), $portfolio_markup);
$portfolio_markup = str_replace('Latest <span>Articles</span>', esc_html(mp_editor_get('blog_heading')), $portfolio_markup);






$portfolio_markup = str_replace('__FOOTER_NAME__', esc_html(mp_editor_get('footer_name')), $portfolio_markup);
$mp_small_overrides = [
 'Java' => 'project_1_language', 'Python' => 'project_2_language',
 'HTML/CSS/JS' => 'project_3_language', 'React JS' => 'project_4_language',
 'Programming' => 'edu_highlight_1', 'Networking' => 'edu_highlight_2',
 'Database' => 'edu_highlight_3', 'Cybersecurity' => 'edu_highlight_4', 'Web & Mobile' => 'edu_highlight_5',
 'May 15, 2025' => 'blog_1_date', 'April 28, 2025' => 'blog_2_date', 'April 10, 2025' => 'blog_3_date',
 'Development' => 'blog_1_category', 'Design' => 'blog_2_category'
];
foreach ($mp_small_overrides as $original=>$key) $portfolio_markup = str_replace($original, esc_html(mp_editor_get($key)), $portfolio_markup);




foreach (['Years'=>'edu_stat_label_1','Courses'=>'edu_stat_label_2','Projects'=>'edu_stat_label_3','Awards'=>'edu_stat_label_4'] as $original=>$key) $portfolio_markup = str_replace('>'.$original.'</span>', '>'.esc_html(mp_editor_get($key)).'</span>', $portfolio_markup);
foreach (['facebook','instagram','telegram','github'] as $social) {
    $label = ucfirst($social);
    $portfolio_markup = str_replace('href="#" aria-label="'.$label.'"', 'href="'.esc_url(mp_editor_get('social_'.$social)).'" aria-label="'.$label.'" target="_blank" rel="noopener noreferrer"', $portfolio_markup);
}


$mp_counter_map = [
 ['class="stat-number" data-count="120"', 'stat_1_count'],
 ['class="stat-number" data-count="85"', 'stat_2_count'],
 ['class="stat-number" data-count="15"', 'stat_3_count'],
 ['class="stat-number" data-count="500000"', 'stat_4_count'],
 ['class="edu-stat-number" data-count="4"', 'edu_stat_1'],
 ['class="edu-stat-number" data-count="40"', 'edu_stat_2'],
 ['class="edu-stat-number" data-count="15"', 'edu_stat_3'],
 ['class="edu-stat-number" data-count="3"', 'edu_stat_4'],
];
foreach ($mp_counter_map as [$original, $key]) $portfolio_markup = str_replace($original, str_replace(preg_match('/data-count="([^"]+)"/',$original,$m) ? $m[1] : '', esc_attr(mp_editor_get($key)), $original), $portfolio_markup);


$portfolio_markup = str_replace('PERSONAL <span>PORTFOLIO</span>', esc_html(mp_editor_get('nav_logo')), $portfolio_markup);
$portfolio_markup = str_replace('About <span>Us</span>', esc_html(mp_editor_get('about_title')), $portfolio_markup);
$mp_edu_desc_index = 0;
$portfolio_markup = preg_replace_callback('/<p class="edu-description">.*?<\/p>/s', function($match) use (&$mp_edu_desc_index) {
    $mp_edu_desc_index++;
    $key = $mp_edu_desc_index === 1 ? 'education_description1' : 'education_description2';
    return '<p class="edu-description">'.esc_html(mp_editor_get($key)).'</p>';
}, $portfolio_markup, 2);


$mp_service_tags = [];
for ($i=1; $i<=4; $i++) {
    $tags = array_filter(array_map('trim', explode(',', mp_editor_get('service_'.$i.'_tags'))));
    $mp_service_tags[] = '<div class="service-langs">'.implode('', array_map(function($tag){ return '<span>'.esc_html($tag).'</span>'; }, $tags)).'</div>';
}
$mp_service_index = 0;
$portfolio_markup = preg_replace_callback('/<div class="service-langs">.*?<\/div>/s', function($match) use (&$mp_service_index, $mp_service_tags) {
    $replacement = $mp_service_tags[$mp_service_index] ?? $match[0];
    $mp_service_index++;
    return $replacement;
}, $portfolio_markup, 4);
$mp_avatar_index = 0;
$portfolio_markup = preg_replace_callback('/<div class="author-avatar"><i class="fas fa-user"><\/i><\/div>/s', function($match) use (&$mp_avatar_index) {
    $mp_avatar_index++;
    $url = mp_editor_get('testimonial_'.$mp_avatar_index.'_avatar');
    return $url ? '<div class="author-avatar"><img src="'.esc_url($url).'" alt="Testimonial author"></div>' : $match[0];
}, $portfolio_markup, 3);

echo $portfolio_markup;
?>
<?php get_footer(); ?>
