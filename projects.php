<?php 
$pageTitle = "Projects";
include 'includes/header.php'; 
?>

<style>
    /* Hero Section */
    .projects-hero {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #E6F0FF 0%, #FFFFFF 50%, #E6F0FF 100%);
        position: relative;
        overflow: hidden;
        padding: 0 2rem;
        margin-top: 80px;
        text-align: center;
    }

    .projects-hero::before {
        content: '';
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(0, 102, 255, 0.12) 0%, transparent 70%);
        border-radius: 50%;
        top: -250px;
        right: -200px;
        animation: float 20s ease-in-out infinite;
    }

    .projects-hero::after {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(0, 71, 171, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        bottom: -200px;
        left: -150px;
        animation: float 15s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(30px, -30px) rotate(5deg); }
        50% { transform: translate(-20px, 20px) rotate(-5deg); }
        75% { transform: translate(20px, 10px) rotate(3deg); }
    }

    .projects-hero-content {
        max-width: 800px;
        position: relative;
        z-index: 1;
        opacity: 0;
        animation: fadeInUp 1s ease forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
        from {
            opacity: 0;
            transform: translateY(30px);
        }
    }

    .projects-hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        color: var(--text-dark);
    }

    .projects-hero-content h1 span {
        color: var(--primary-blue);
        position: relative;
        display: inline-block;
    }

    .projects-hero-content p {
        font-size: 1.2rem;
        color: var(--text-gray);
        line-height: 1.8;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Project Filters */
    .project-filters {
        padding: 2rem 2rem 0;
        background: var(--white);
    }

    .filters-content {
        max-width: 1400px;
        margin: 0 auto;
        text-align: center;
    }

    .filters-list {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .filter-btn {
        padding: 0.7rem 1.8rem;
        background: var(--white);
        border: 2px solid var(--border-color);
        border-radius: 50px;
        color: var(--text-gray);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .filter-btn:hover {
        border-color: var(--primary-blue);
        color: var(--primary-blue);
        transform: translateY(-2px);
    }

    .filter-btn.active {
        background: var(--primary-blue);
        border-color: var(--primary-blue);
        color: var(--white);
    }

    .project-count {
        color: var(--text-gray);
        font-size: 0.95rem;
        font-weight: 500;
    }

    /* Projects Grid */
    .projects-grid-section {
        padding: 3rem 2rem 6rem;
        background: var(--white);
    }

    .projects-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 3rem;
    }

    .project-card {
        background: var(--white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
        border: 2px solid transparent;
        position: relative;
    }

    .project-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .project-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 102, 255, 0.15);
        border-color: var(--primary-blue);
    }

    .project-image {
        width: 100%;
        height: 280px;
        overflow: hidden;
        position: relative;
    }

    .project-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .project-card:hover .project-image img {
        transform: scale(1.1);
    }

    .project-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 102, 255, 0.9), rgba(0, 71, 171, 0.9));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .project-card:hover .project-overlay {
        opacity: 1;
    }

    .project-links {
        display: flex;
        gap: 1rem;
    }

    .project-link {
        width: 50px;
        height: 50px;
        background: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-blue);
        text-decoration: none;
        transition: all 0.3s ease;
        transform: translateY(20px);
        opacity: 0;
    }

    .project-card:hover .project-link {
        transform: translateY(0);
        opacity: 1;
    }

    .project-card:hover .project-link:nth-child(1) {
        transition-delay: 0.1s;
    }

    .project-card:hover .project-link:nth-child(2) {
        transition-delay: 0.2s;
    }

    .project-link:hover {
        background: var(--dark-blue);
        color: var(--white);
        transform: translateY(-5px);
    }

    .project-info {
        padding: 2rem;
    }

    .project-category {
        color: var(--primary-blue);
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
        display: inline-block;
        padding: 0.3rem 1rem;
        background: rgba(0, 102, 255, 0.1);
        border-radius: 50px;
    }

    .project-info h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .project-info p {
        color: var(--text-gray);
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .project-tech {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .tech-tag {
        padding: 0.3rem 0.8rem;
        background: var(--light-blue);
        color: var(--primary-blue);
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .project-date {
        color: var(--text-gray);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .project-date i {
        color: var(--primary-blue);
    }

    /* Testimonial Section */
    .project-testimonial {
        padding: 6rem 2rem;
        background: var(--light-blue);
    }

    .testimonial-content {
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
        position: relative;
    }

    .testimonial-content::before {
        content: '"';
        position: absolute;
        top: -50px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 10rem;
        color: rgba(0, 102, 255, 0.1);
        font-family: serif;
    }

    .testimonial-text {
        font-size: 1.5rem;
        line-height: 1.8;
        color: var(--text-dark);
        margin-bottom: 2rem;
        font-style: italic;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    .author-image {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid var(--white);
    }

    .author-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .author-info h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.3rem;
    }

    .author-info p {
        color: var(--text-gray);
        font-size: 0.9rem;
    }

    /* Stats Section */
    .projects-stats {
        padding: 5rem 2rem;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        color: var(--white);
    }

    .stats-content {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 3rem;
        text-align: center;
    }

    .stat-item {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .stat-item.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .stat-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.9;
    }

    .stat-number {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        display: block;
    }

    .stat-label {
        font-size: 1.1rem;
        opacity: 0.9;
        font-weight: 500;
    }

    /* CTA Section */
    .cta-section {
        padding: 6rem 2rem;
        background: var(--white);
        text-align: center;
    }

    .cta-content {
        max-width: 900px;
        margin: 0 auto;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .cta-content.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .cta-content h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        color: var(--text-dark);
    }

    .cta-content p {
        font-size: 1.2rem;
        color: var(--text-gray);
        margin-bottom: 2.5rem;
        line-height: 1.8;
    }

    .btn {
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        font-size: 1rem;
    }

    .btn-primary {
        background: var(--primary-blue);
        color: var(--white);
        border: 2px solid var(--primary-blue);
    }

    .btn-primary:hover {
        background: var(--dark-blue);
        border-color: var(--dark-blue);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0, 102, 255, 0.3);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .projects-grid {
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2.5rem;
        }
    }

    @media (max-width: 968px) {
        .projects-hero-content h1 {
            font-size: 2.8rem;
        }

        .projects-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .testimonial-text {
            font-size: 1.3rem;
        }

        .stats-content {
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }
    }

    @media (max-width: 768px) {
        .projects-hero {
            min-height: 50vh;
            margin-top: 70px;
            padding: 3rem 1.5rem;
        }

        .projects-hero-content h1 {
            font-size: 2.2rem;
        }

        .projects-hero-content p {
            font-size: 1.1rem;
        }

        .project-filters, .projects-grid-section, .project-testimonial, .projects-stats, .cta-section {
            padding: 3rem 1.5rem;
        }

        .projects-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .project-image {
            height: 250px;
        }

        .filters-list {
            flex-direction: column;
            align-items: center;
        }

        .filter-btn {
            width: 100%;
            max-width: 250px;
        }

        .testimonial-text {
            font-size: 1.1rem;
        }

        .stats-content {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .stat-number {
            font-size: 2.8rem;
        }

        .cta-content h2 {
            font-size: 1.8rem;
        }

        .cta-content p {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .projects-hero-content h1 {
            font-size: 1.8rem;
        }

        .projects-hero-content p {
            font-size: 1rem;
        }

        .project-info {
            padding: 1.5rem;
        }

        .project-info h3 {
            font-size: 1.3rem;
        }

        .btn {
            padding: 0.9rem 2rem;
            font-size: 0.95rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="projects-hero">
    <div class="projects-hero-content">
        <h1>Our <span>Portfolio</span> of Success</h1>
        <p>Explore our collection of innovative projects that showcase our expertise in web development, AI solutions, and digital transformation.</p>
    </div>
</section>

<!-- Project Filters -->
<section class="project-filters">
    <div class="filters-content">
        <div class="filters-list">
            <button class="filter-btn active" data-filter="all">All Projects</button>
            <button class="filter-btn" data-filter="web">Website Development</button>
            <button class="filter-btn" data-filter="webapp">Web Applications</button>
            <button class="filter-btn" data-filter="ai">AI Solutions</button>
            <button class="filter-btn" data-filter="ecommerce">E-commerce</button>
            <button class="filter-btn" data-filter="mobile">Mobile Apps</button>
        </div>
        <p class="project-count">Showing <span id="projectCount">12</span> projects</p>
    </div>
</section>

<!-- Projects Grid -->
<section class="projects-grid-section">
    <div class="projects-grid" id="projectsGrid">
        <!-- Project 1 - E-commerce -->
        <div class="project-card" data-category="ecommerce web">
            <div class="project-image">
                <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=600&h=400&fit=crop" alt="E-commerce Platform">
                <div class="project-overlay">
                    <div class="project-links">
                        <a href="#" class="project-link" aria-label="Live Preview">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <a href="#" class="project-link" aria-label="View Details">
                            <i class="fas fa-search-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-info">
                <span class="project-category">E-COMMERCE</span>
                <h3>Modern Fashion Retail Platform</h3>
                <p>A complete e-commerce solution with advanced features like AI-powered recommendations, real-time inventory, and seamless payment integration.</p>
                <div class="project-tech">
                    <span class="tech-tag">React</span>
                    <span class="tech-tag">Node.js</span>
                    <span class="tech-tag">MongoDB</span>
                    <span class="tech-tag">Stripe API</span>
                </div>
                <div class="project-date">
                    <i class="far fa-calendar"></i>
                    <span>Completed: March 2024</span>
                </div>
            </div>
        </div>

        <!-- Project 2 - AI Solution -->
        <div class="project-card" data-category="ai webapp">
            <div class="project-image">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop" alt="AI Analytics Dashboard">
                <div class="project-overlay">
                    <div class="project-links">
                        <a href="#" class="project-link" aria-label="Live Preview">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <a href="#" class="project-link" aria-label="View Details">
                            <i class="fas fa-search-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-info">
                <span class="project-category">AI SOLUTION</span>
                <h3>Intelligent Business Analytics</h3>
                <p>AI-powered dashboard that provides predictive analytics, trend forecasting, and actionable insights for data-driven decision making.</p>
                <div class="project-tech">
                    <span class="tech-tag">Python</span>
                    <span class="tech-tag">TensorFlow</span>
                    <span class="tech-tag">D3.js</span>
                    <span class="tech-tag">PostgreSQL</span>
                </div>
                <div class="project-date">
                    <i class="far fa-calendar"></i>
                    <span>Completed: January 2024</span>
                </div>
            </div>
        </div>

        <!-- Project 3 - Web Application -->
        <div class="project-card" data-category="webapp mobile">
            <div class="project-image">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop" alt="Project Management System">
                <div class="project-overlay">
                    <div class="project-links">
                        <a href="#" class="project-link" aria-label="Live Preview">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <a href="#" class="project-link" aria-label="View Details">
                            <i class="fas fa-search-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-info">
                <span class="project-category">WEB APP</span>
                <h3>Enterprise Project Management</h3>
                <p>Collaborative platform for teams to manage projects, track progress, allocate resources, and communicate efficiently in real-time.</p>
                <div class="project-tech">
                    <span class="tech-tag">Vue.js</span>
                    <span class="tech-tag">Laravel</span>
                    <span class="tech-tag">MySQL</span>
                    <span class="tech-tag">WebSocket</span>
                </div>
                <div class="project-date">
                    <i class="far fa-calendar"></i>
                    <span>Completed: November 2023</span>
                </div>
            </div>
        </div>

        <!-- Project 4 - Website Development -->
        <div class="project-card" data-category="web">
            <div class="project-image">
                <img src="https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?w=600&h=400&fit=crop" alt="Corporate Website">
                <div class="project-overlay">
                    <div class="project-links">
                        <a href="#" class="project-link" aria-label="Live Preview">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <a href="#" class="project-link" aria-label="View Details">
                            <i class="fas fa-search-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-info">
                <span class="project-category">WEBSITE</span>
                <h3>Global Corporate Portal</h3>
                <p>A sophisticated corporate website with multilingual support, investor relations portal, and integrated CMS for global brand presence.</p>
                <div class="project-tech">
                    <span class="tech-tag">Next.js</span>
                    <span class="tech-tag">WordPress</span>
                    <span class="tech-tag">GraphQL</span>
                    <span class="tech-tag">Redis</span>
                </div>
                <div class="project-date">
                    <i class="far fa-calendar"></i>
                    <span>Completed: September 2023</span>
                </div>
            </div>
        </div>

        <!-- Project 5 - E-commerce -->
        <div class="project-card" data-category="ecommerce webapp">
            <div class="project-image">
                <img src="https://images.unsplash.com/photo-1556742044-3c52d6e88c62?w=600&h=400&fit=crop" alt="Online Marketplace">
                <div class="project-overlay">
                    <div class="project-links">
                        <a href="#" class="project-link" aria-label="Live Preview">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <a href="#" class="project-link" aria-label="View Details">
                            <i class="fas fa-search-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-info">
                <span class="project-category">E-COMMERCE</span>
                <h3>Multi-Vendor Marketplace</h3>
                <p>A scalable marketplace platform connecting buyers and sellers with advanced vendor management and commission systems.</p>
                <div class="project-tech">
                    <span class="tech-tag">React</span>
                    <span class="tech-tag">Express.js</span>
                    <span class="tech-tag">MongoDB</span>
                    <span class="tech-tag">AWS</span>
                </div>
                <div class="project-date">
                    <i class="far fa-calendar"></i>
                    <span>Completed: July 2023</span>
                </div>
            </div>
        </div>

        <!-- Project 6 - AI Solution -->
        <div class="project-card" data-category="ai">
            <div class="project-image">
                <img src="https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=600&h=400&fit=crop" alt="Chatbot System">
                <div class="project-overlay">
                    <div class="project-links">
                        <a href="#" class="project-link" aria-label="Live Preview">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <a href="#" class="project-link" aria-label="View Details">
                            <i class="fas fa-search-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-info">
                <span class="project-category">AI SOLUTION</span>
                <h3>Intelligent Customer Support</h3>
                <p>AI-powered chatbot system with natural language processing that handles customer queries 24/7 and integrates with CRM systems.</p>
                <div class="project-tech">
                    <span class="tech-tag">Python</span>
                    <span class="tech-tag">NLP</span>
                    <span class="tech-tag">React</span>
                    <span class="tech-tag">Firebase</span>
                </div>
                <div class="project-date">
                    <i class="far fa-calendar"></i>
                    <span>Completed: May 2023</span>
                </div>
            </div>
        </div>

        <!-- Project 7 - Web Application -->
        <div class="project-card" data-category="webapp mobile">
            <div class="project-image">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=400&fit=crop" alt="Fitness App">
                <div class="project-overlay">
                    <div class="project-links">
                        <a href="#" class="project-link" aria-label="Live Preview">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <a href="#" class="project-link" aria-label="View Details">
                            <i class="fas fa-search-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-info">
                <span class="project-category">WEB APP</span>
                <h3>Health & Fitness Platform</h3>
                <p>A comprehensive fitness app with workout tracking, nutrition planning, progress analytics, and social features for community engagement.</p>
                <div class="project-tech">
                    <span class="tech-tag">React Native</span>
                    <span class="tech-tag">Node.js</span>
                    <span class="tech-tag">MongoDB</span>
                    <span class="tech-tag">Chart.js</span>
                </div>
                <div class="project-date">
                    <i class="far fa-calendar"></i>
                    <span>Completed: March 2023</span>
                </div>
            </div>
        </div>

        <!-- Project 8 - Website Development -->
        <div class="project-card" data-category="web">
            <div class="project-image">
                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&h=400&fit=crop" alt="Educational Platform">
                <div class="project-overlay">
                    <div class="project-links">
                        <a href="#" class="project-link" aria-label="Live Preview">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        <a href="#" class="project-link" aria-label="View Details">
                            <i class="fas fa-search-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="project-info">
                <span class="project-category">WEBSITE</span>
                <h3>Online Learning Platform</h3>
                <p>An interactive educational website with video courses, quizzes, progress tracking, and certificate generation for online learners.</p>
                <div class="project-tech">
                    <span class="tech-tag">Angular</span>
                    <span class="tech-tag">Django</span>
                    <span class="tech-tag">PostgreSQL</span>
                    <span class="tech-tag">AWS S3</span>
                </div>
                <div class="project-date">
                    <i class="far fa-calendar"></i>
                    <span>Completed: January 2023</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="project-testimonial">
    <div class="testimonial-content">
        <p class="testimonial-text">
            "Horizon Tech delivered a transformative solution that exceeded our expectations. Their attention to detail, technical expertise, and commitment to our success were evident throughout the project. The platform they built has become central to our operations and has significantly improved our efficiency."
        </p>
        <div class="testimonial-author">
            <div class="author-image">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&h=120&fit=crop" alt="Robert Johnson">
            </div>
            <div class="author-info">
                <h4>Robert Johnson</h4>
                <p>CEO, InnovateCorp</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="projects-stats">
    <div class="stats-content">
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-project-diagram"></i>
            </div>
            <span class="stat-number" data-target="150">0</span>
            <span class="stat-label">Projects Completed</span>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <span class="stat-number" data-target="12000">0</span>
            <span class="stat-label">Development Hours</span>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-smile"></i>
            </div>
            <span class="stat-number" data-target="98">0</span>
            <span class="stat-label">Client Satisfaction</span>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-code-branch"></i>
            </div>
            <span class="stat-number" data-target="45">0</span>
            <span class="stat-label">Technologies Used</span>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-content">
        <h2>Have a Project in Mind?</h2>
        <p>Let's collaborate to create something exceptional. Our team is ready to bring your vision to life with cutting-edge technology and innovative solutions.</p>
        <a href="contact.php" class="btn btn-primary">
            Start Your Project
            <i class="fas fa-rocket"></i>
        </a>
    </div>
</section>

<script>
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('.project-card, .stat-item, .cta-content').forEach(el => {
        observer.observe(el);
    });

    // Project filtering functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');
    const projectCount = document.getElementById('projectCount');

    function filterProjects(category) {
        let visibleCount = 0;
        
        projectCards.forEach(card => {
            const cardCategory = card.getAttribute('data-category');
            
            if (category === 'all' || cardCategory.includes(category)) {
                card.style.display = 'block';
                visibleCount++;
                
                // Add slight delay for staggered appearance
                setTimeout(() => {
                    observer.observe(card);
                }, 50);
            } else {
                card.style.display = 'none';
            }
        });
        
        projectCount.textContent = visibleCount;
    }

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            button.classList.add('active');
            
            // Filter projects
            const filterValue = button.getAttribute('data-filter');
            filterProjects(filterValue);
        });
    });

    // Animated counter for stats
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += step;
            if (current < target) {
                element.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target;
            }
        };

        updateCounter();
    }

    // Trigger counter animation when stats section is visible
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                const counter = entry.target.querySelector('.stat-number');
                if (counter) animateCounter(counter);
                statsObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.stat-item').forEach(el => {
        statsObserver.observe(el);
    });

    // Stagger animation for project cards
    const allProjectCards = document.querySelectorAll('.project-card');
    allProjectCards.forEach((card, index) => {
        setTimeout(() => {
            observer.observe(card);
        }, index * 100);
    });
</script>

<?php include 'includes/footer.php'; ?>