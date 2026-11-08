
        document.addEventListener("DOMContentLoaded", () => {
            setTimeout(() => {
                const intro = document.getElementById("introScreen");
                const nav = document.getElementById("mainNav");
                const img = document.getElementById("teamImage");
                
                if (intro) intro.classList.add("hide");
                if (nav) nav.classList.add("active");
                
                document.querySelector(".hero-title")?.classList.add("visible");
                document.querySelector(".hero-subtitle")?.classList.add("visible");
                document.querySelector(".hero-desc")?.classList.add("visible");
                document.querySelector(".hero-buttons")?.classList.add("visible");
                
                if (img) img.classList.add("visible");
                
            }, 2600); 
        });
    
if (window.AOS) AOS.init({offset:0});

    document.addEventListener("DOMContentLoaded", () => {
        /* Theme toggle removed: portfolio remains in its original dark appearance. */



        /* ---------- 1. SKILLS MODAL ---------- */
        const fallbackMembersData = {
            maria: {
                name: "Maria Blanquera", role: "PROJECT MANAGER", photo: ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/maria.png",
                skills: [ { name: "Project Planning", percent: 95 }, { name: "Team Leadership", percent: 92 }, { name: "Agile & Scrum", percent: 90 }, { name: "Risk Management", percent: 88 }, { name: "Communication", percent: 96 } ],
                tags: ["Jira", "Trello", "Asana", "Slack", "Notion", "MS Project"]
            },
            jefferson: {
                name: "Jefferson Ponce", role: "PROGRAMMER", photo: ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/jefferson.png",
                skills: [ { name: "JavaScript / TypeScript", percent: 94 }, { name: "HTML & CSS", percent: 96 }, { name: "React / Node.js", percent: 90 }, { name: "PHP & MySQL", percent: 85 }, { name: "UI / UX Implementation", percent: 88 } ],
                tags: ["React", "Node.js", "PHP", "MySQL", "Tailwind", "Git", "Figma"]
            },
            geo: {
                name: "Geoffrey Bermudez", role: "ANALYST", photo: ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/geo.png",
                skills: [ { name: "Requirement Analysis", percent: 93 }, { name: "Data Analysis", percent: 90 }, { name: "System Design", percent: 87 }, { name: "Documentation", percent: 91 }, { name: "Problem Solving", percent: 94 } ],
                tags: ["SQL", "Excel", "Power BI", "Visio", "Lucidchart", "Python"]
            },
            adriane: {
                name: "Adriane Manggay", role: "TECHNICAL WRITER", photo: ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/adriane.png",
                skills: [ { name: "Technical Documentation", percent: 96 }, { name: "User Manuals", percent: 94 }, { name: "Content Editing", percent: 90 }, { name: "Research & Accuracy", percent: 92 }, { name: "Information Architecture", percent: 88 } ],
                tags: ["Markdown", "Confluence", "MadCap Flare", "GitBook", "Snagit", "Word"]
            }
        };
        const membersData = (window.MyPortfolio && MyPortfolio.members) ? MyPortfolio.members : fallbackMembersData;

        const skillsOverlay = document.getElementById("skillsModal");
        const skillsCloseBtn = document.getElementById("skillsModalClose");
        const modalPhoto = document.getElementById("modalPhoto");
        const modalName = document.getElementById("modalName");
        const modalRole = document.getElementById("modalRole");
        const modalSkills = document.getElementById("modalSkills");
        const modalTags = document.getElementById("modalTags");

        function openSkillsModal(key) {
            const data = membersData[key];
            if (!data) return;
            modalPhoto.src = data.photo; modalPhoto.alt = data.name;
            modalName.textContent = data.name; modalRole.textContent = data.role;
            modalSkills.innerHTML = ""; modalTags.innerHTML = "";

            data.skills.forEach(skill => {
                const item = document.createElement("div");
                item.className = "skill-item";
                item.innerHTML = `
                    <div class="skill-info">
                        <span class="skill-name">${skill.name}</span>
                        <span class="skill-percent">${skill.percent}%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-bar-fill" data-target="${skill.percent}" style="width:0%"></div>
                    </div>
                `;
                modalSkills.appendChild(item);
            });

            data.tags.forEach(tag => {
                const span = document.createElement("span");
                span.className = "skill-tag"; span.textContent = tag;
                modalTags.appendChild(span);
            });

            if (!skillsOverlay) return;
            skillsOverlay.classList.add("active");
            document.body.classList.add("modal-open");
            setTimeout(() => {
                document.querySelectorAll(".skill-bar-fill").forEach(bar => {
                    bar.style.width = bar.dataset.target + "%";
                });
            }, 150);
        }

        function closeSkillsModal() {
            if (skillsOverlay) skillsOverlay.classList.remove("active");
            document.body.classList.remove("modal-open");
            setTimeout(() => {
                document.querySelectorAll(".skill-bar-fill").forEach(bar => bar.style.width = "0%");
            }, 400);
        }

        document.querySelectorAll(".card-image[data-member], .view-skills-label[data-member]").forEach(el => {
            el.addEventListener("click", () => openSkillsModal(el.dataset.member));
        });

        if (skillsCloseBtn) skillsCloseBtn.addEventListener("click", closeSkillsModal);
        if (skillsOverlay) skillsOverlay.addEventListener("click", (e) => { if (e.target === skillsOverlay) closeSkillsModal(); });


        /* ---------- 2. PROJECTS MODAL & SLIDER ---------- */
        // Each project now has an array of 5 images for the slider
        const fallbackProjectsData = {
            java: {
                title: "Inventory Management System",
                lang: '<i class="fab fa-java"></i> Java',
                images: [
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/java.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/java1.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/java2.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/java3.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/java4.jpg"
                ],
                desc: "A comprehensive desktop solution designed for small to medium enterprises. This system effectively handles stock tracking, supplier management, and sales reporting, ensuring smooth operations and real-time data accuracy.",
                features: [
                    "Real-time stock level monitoring",
                    "Automated reorder alerts",
                    "Supplier and product database management",
                    "Secure user authentication and role-based access",
                    "Detailed sales and inventory reporting",
                    "Export reports to PDF and Excel"
                ]
            },
            python: {
                title: "AI Chatbot Assistant",
                lang: '<i class="fab fa-python"></i> Python',
                images: [
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/python.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/python1.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/python2.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/python3.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/python4.jpg"
                ],
                desc: "An advanced customer support bot leveraging Natural Language Processing (NLP). It can understand user intents, answer FAQs, and escalate complex issues to human agents, providing 24/7 automated assistance.",
                features: [
                    "Natural Language Understanding (NLU)",
                    "Context-aware conversation tracking",
                    "Multi-platform integration (Web, Messenger)",
                    "Automated FAQ responses",
                    "Seamless human hand-off",
                    "Analytics dashboard for user interactions"
                ]
            },
            web: {
                title: "E-Commerce Landing Page",
                lang: '<i class="fab fa-html5"></i> HTML/CSS/JS',
                images: [
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/html.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/html1.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/html2.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/html3.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/html4.jpg"
                ],
                desc: "A visually striking, high-conversion landing page tailored for a modern fashion brand. Built entirely from scratch with a focus on responsive design, fast loading times, and smooth scroll animations.",
                features: [
                    "Fully responsive mobile-first design",
                    "Interactive product image galleries",
                    "Smooth scroll and parallax animations",
                    "Optimized SEO structure",
                    "Newsletter subscription integration",
                    "Custom CSS animations"
                ]
            },
            react: {
                title: "Task Management Dashboard",
                lang: '<i class="fab fa-react"></i> React JS',
                images: [
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/react.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/react1.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/react2.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/react3.jpg", 
                    ((window.MyPortfolio && MyPortfolio.assetBase) || "") + "/react4.jpg"
                ],
                desc: "A dynamic Single Page Application (SPA) built for teams. It features a drag-and-drop interface for task management, real-time updates, and a clean, intuitive UI that keeps teams organized and productive.",
                features: [
                    "Drag-and-drop Kanban board",
                    "Real-time state management",
                    "User-specific task assignments",
                    "Progress tracking and deadlines",
                    "Dark mode support",
                    "Local storage data persistence"
                ]
            }
        };;
        const wpProjects = (window.MyPortfolio && MyPortfolio.projects) ? MyPortfolio.projects : {};
        const projectsData = Object.assign({}, fallbackProjectsData, wpProjects);
        const projectAliases = {
            "inventory-management-system": "java",
            "ai-chatbot-assistant": "python",
            "e-commerce-landing-page": "web",
            "task-management-dashboard": "react"
        };


        const projectOverlay = document.getElementById("projectModal");
        const projectCloseBtn = document.getElementById("projectModalClose");
        const pmTrack = document.getElementById("pmTrack");
        const pmDots = document.getElementById("pmDots");
        const pmPrev = document.getElementById("pmPrev");
        const pmNext = document.getElementById("pmNext");
        const pmLang = document.getElementById("pmLang");
        const pmTitle = document.getElementById("pmTitle");
        const pmDesc = document.getElementById("pmDesc");
        const pmFeatures = document.getElementById("pmFeatures");

        let currentSlide = 0;
        let totalSlides = 5;

        function updateSlider() {
            pmTrack.style.transform = `translateX(-${currentSlide * 100}%)`;
            const dots = pmDots.querySelectorAll(".slider-dot");
            dots.forEach((dot, index) => {
                dot.classList.toggle("active", index === currentSlide);
            });
        }

        function openProjectModal(key) {
            const data = projectsData[key] || projectsData[projectAliases[key]];
            if (!data) {
                console.error("Portfolio project data not found for:", key);
                return;
            }

            // Use the original local project images when WordPress has no slider images.
            const fallbackKey = projectAliases[key] || key;
            const fallback = fallbackProjectsData[fallbackKey];
            const images = (Array.isArray(data.images) && data.images.length)
                ? data.images
                : (fallback ? fallback.images : []);
            const features = Array.isArray(data.features) ? data.features : (fallback ? fallback.features : []);
            const description = data.desc || data.description || (fallback ? fallback.desc : "");
            const language = data.lang || (fallback ? fallback.lang : "");

            // Populate Slider
            pmTrack.innerHTML = "";
            pmDots.innerHTML = "";
            totalSlides = images.length;
            currentSlide = 0;

            images.forEach((imgSrc, index) => {
                // Add image
                const img = document.createElement("img");
                img.src = imgSrc;
                img.alt = `${data.title} Image ${index + 1}`;
                pmTrack.appendChild(img);

                // Add dot
                const dot = document.createElement("div");
                dot.className = `slider-dot ${index === 0 ? 'active' : ''}`;
                dot.addEventListener("click", () => {
                    currentSlide = index;
                    updateSlider();
                });
                pmDots.appendChild(dot);
            });

            updateSlider();

            // Populate Info
            pmLang.innerHTML = data.lang;
            pmTitle.textContent = data.title;
            pmDesc.textContent = data.desc;
            
            pmFeatures.innerHTML = "";
            data.features.forEach(feature => {
                const li = document.createElement("li");
                li.innerHTML = `<i class="fas fa-check-circle"></i> ${feature}`;
                pmFeatures.appendChild(li);
            });

            if (!projectOverlay) return;
            projectOverlay.classList.add("active");
            document.body.classList.add("modal-open");
        }

        function closeProjectModal() {
            if (projectOverlay) projectOverlay.classList.remove("active");
            document.body.classList.remove("modal-open");
        }

        // Slider Arrow Buttons
        if (pmPrev) pmPrev.addEventListener("click", () => {
            if (!totalSlides) return;
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlider();
        });

        if (pmNext) pmNext.addEventListener("click", () => {
            if (!totalSlides) return;
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        });

        document.querySelectorAll(".project-link[data-project]").forEach(btn => {
            btn.addEventListener("click", () => openProjectModal(btn.dataset.project));
        });

        if (projectCloseBtn) projectCloseBtn.addEventListener("click", closeProjectModal);
        if (projectOverlay) projectOverlay.addEventListener("click", (e) => { if (e.target === projectOverlay) closeProjectModal(); });
        
        // Global Escape key for both modals
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                if (skillsOverlay && skillsOverlay.classList.contains("active")) closeSkillsModal();
                if (projectOverlay && projectOverlay.classList.contains("active")) closeProjectModal();
            }
        });


        /* ---------- 3. NUMBER COUNTERS ---------- */
        let statsAnimated = false;
        const statNumbers = document.querySelectorAll(".edu-stat-number, .stat-number");

        function animateNumbers() {
            if (statsAnimated) return;
            
            const eduSection = document.querySelector(".education-section");
            const achSection = document.querySelector(".achievements-section");
            let trigger = false;

            if (eduSection) {
                const rect = eduSection.getBoundingClientRect();
                if (rect.top < window.innerHeight - 200 && rect.bottom > 0) trigger = true;
            }
            if (achSection) {
                const rect = achSection.getBoundingClientRect();
                if (rect.top < window.innerHeight - 200 && rect.bottom > 0) trigger = true;
            }

            if (trigger) {
                statsAnimated = true;
                statNumbers.forEach(stat => {
                    const target = parseInt(stat.dataset.count, 10);
                    const suffix = stat.dataset.suffix || "";
                    let current = 0;
                    const step = Math.max(1, Math.ceil(target / 50));
                    const timer = setInterval(() => {
                        current += step;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        stat.textContent = current + suffix;
                    }, 30);
                });
            }
        }

        window.addEventListener("scroll", animateNumbers);
        window.addEventListener("load", animateNumbers);
    });
    