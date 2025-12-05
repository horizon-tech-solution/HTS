<?php 
$pageTitle = "About Us";
include 'includes/header.php'; 
?>

<style>
    /* Hero Section */
    .about-hero {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #E6F0FF 0%, #FFFFFF 50%, #E6F0FF 100%);
        position: relative;
        overflow: hidden;
        padding: 0 2rem;
        margin-top: 80px;
    }

    .about-hero::before {
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

    .about-hero::after {
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

    .about-hero-content {
        max-width: 1000px;
        text-align: center;
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

    .about-hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        color: var(--text-dark);
    }

    .about-hero-content h1 span {
        color: var(--primary-blue);
        position: relative;
        display: inline-block;
    }

    .about-hero-content p {
        font-size: 1.3rem;
        color: var(--text-gray);
        line-height: 1.8;
        max-width: 800px;
        margin: 0 auto;
    }

    /* Story Section */
    .our-story {
        padding: 6rem 2rem;
        background: var(--white);
    }

    .story-content {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5rem;
        align-items: center;
    }

    .story-image {
        position: relative;
        opacity: 0;
        transform: translateX(-30px);
        transition: all 0.6s ease;
    }

    .story-image.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .story-image img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 102, 255, 0.2);
    }

    .story-image::before {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: var(--light-blue);
        border-radius: 20px;
        top: -20px;
        left: -20px;
        z-index: -1;
    }

    .story-text {
        opacity: 0;
        transform: translateX(30px);
        transition: all 0.6s ease;
    }

    .story-text.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .section-label {
        color: var(--primary-blue);
        font-weight: 700;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 1rem;
        display: block;
    }

    .story-text h2 {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        color: var(--text-dark);
        line-height: 1.2;
    }

    .story-text h2 span {
        color: var(--primary-blue);
    }

    .story-text p {
        font-size: 1.1rem;
        color: var(--text-gray);
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .highlight-box {
        background: var(--light-blue);
        padding: 2rem;
        border-radius: 15px;
        border-left: 4px solid var(--primary-blue);
        margin-top: 2rem;
    }

    .highlight-box p {
        margin: 0;
        font-weight: 600;
        color: var(--text-dark);
        font-size: 1.1rem;
    }

    /* Values Section */
    .our-values {
        padding: 6rem 2rem;
        background: var(--light-blue);
    }

    .section-header {
        text-align: center;
        max-width: 700px;
        margin: 0 auto 4rem;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .section-header.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .section-header h2 {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 1rem;
        color: var(--text-dark);
    }

    .section-header h2 span {
        color: var(--primary-blue);
    }

    .section-header p {
        font-size: 1.1rem;
        color: var(--text-gray);
        line-height: 1.8;
    }

    .values-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2.5rem;
    }

    .value-card {
        background: var(--white);
        padding: 3rem 2.5rem;
        border-radius: 20px;
        text-align: center;
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .value-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 0;
    }

    .value-card > * {
        position: relative;
        z-index: 1;
    }

    .value-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .value-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 102, 255, 0.2);
        border-color: var(--primary-blue);
    }

    .value-card:hover::before {
        opacity: 1;
    }

    .value-card:hover h3,
    .value-card:hover p {
        color: var(--white);
    }

    .value-card:hover .value-icon {
        background: var(--white);
    }

    .value-card:hover .value-icon i {
        color: var(--primary-blue);
    }

    .value-icon {
        width: 80px;
        height: 80px;
        background: var(--light-blue);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        transition: all 0.3s ease;
    }

    .value-icon i {
        font-size: 2.2rem;
        color: var(--primary-blue);
        transition: all 0.3s ease;
    }

    .value-card h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--text-dark);
        font-weight: 700;
        transition: color 0.3s ease;
    }

    .value-card p {
        color: var(--text-gray);
        line-height: 1.7;
        transition: color 0.3s ease;
    }

    /* Team Section */
    .our-team {
        padding: 6rem 2rem;
        background: var(--white);
    }

    .team-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2.5rem;
        margin-top: 3rem;
    }

    .team-card {
        background: var(--white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
        border: 2px solid var(--border-color);
    }

    .team-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 102, 255, 0.15);
        border-color: var(--primary-blue);
    }

    .team-image {
        width: 100%;
        height: 320px;
        overflow: hidden;
        position: relative;
        background: var(--light-blue);
    }

    .team-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .team-card:hover .team-image img {
        transform: scale(1.1);
    }

    .team-social {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%) translateY(100%);
        display: flex;
        gap: 0.8rem;
        transition: transform 0.4s ease;
        opacity: 0;
    }

    .team-card:hover .team-social {
        transform: translateX(-50%) translateY(0);
        opacity: 1;
    }

    .social-link {
        width: 40px;
        height: 40px;
        background: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-blue);
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .social-link:hover {
        background: var(--primary-blue);
        color: var(--white);
        transform: translateY(-3px);
    }

    .team-info {
        padding: 2rem;
        text-align: center;
    }

    .team-info h3 {
        font-size: 1.4rem;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .team-role {
        color: var(--primary-blue);
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .team-info p {
        color: var(--text-gray);
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* Mission Vision Section */
    .mission-vision {
        padding: 6rem 2rem;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        color: var(--white);
    }

    .mv-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
    }

    .mv-card {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .mv-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .mv-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .mv-icon i {
        font-size: 2.5rem;
        color: var(--white);
    }

    .mv-card h2 {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
    }

    .mv-card p {
        font-size: 1.1rem;
        line-height: 1.8;
        opacity: 0.95;
    }

    /* Timeline Section */
    .timeline-section {
        padding: 6rem 2rem;
        background: var(--white);
    }

    .timeline {
        max-width: 1000px;
        margin: 3rem auto 0;
        position: relative;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        border-radius: 2px;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 4rem;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .timeline-item.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .timeline-item:nth-child(odd) .timeline-content {
        margin-left: 0;
        margin-right: auto;
        text-align: right;
    }

    .timeline-item:nth-child(even) .timeline-content {
        margin-left: auto;
        margin-right: 0;
    }

    .timeline-content {
        width: calc(50% - 40px);
        background: var(--white);
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 102, 255, 0.1);
        border: 2px solid var(--border-color);
        position: relative;
    }

    .timeline-year {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-weight: 800;
        font-size: 1.2rem;
        box-shadow: 0 8px 20px rgba(0, 102, 255, 0.3);
        border: 4px solid var(--white);
    }

    .timeline-item:nth-child(odd) .timeline-year {
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .timeline-item:nth-child(even) .timeline-year {
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .timeline-content h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .timeline-content p {
        color: var(--text-gray);
        line-height: 1.7;
    }

    /* Stats Section */
    .stats {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        padding: 5rem 2rem;
        color: var(--white);
    }

    .stats-grid {
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
        background: var(--light-blue);
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
        .story-content, .mv-grid {
            gap: 3rem;
        }
    }

    @media (max-width: 968px) {
        .story-content, .mv-grid {
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }

        .about-hero-content h1 {
            font-size: 2.8rem;
        }

        .story-text h2, .section-header h2 {
            font-size: 2.2rem;
        }

        .timeline::before {
            left: 30px;
        }

        .timeline-content {
            width: calc(100% - 100px);
            margin-left: auto !important;
            text-align: left !important;
        }

        .timeline-year {
            left: 30px !important;
            transform: translateX(-50%) !important;
        }

        .team-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }
    }

    @media (max-width: 768px) {
        .about-hero {
            min-height: 60vh;
            margin-top: 70px;
            padding-top: 3rem;
        }

        .about-hero-content h1 {
            font-size: 2.2rem;
        }

        .about-hero-content p {
            font-size: 1.1rem;
        }

        .our-story, .our-values, .our-team, .mission-vision, .timeline-section, .cta-section {
            padding: 3rem 1.5rem;
        }

        .stats {
            padding: 3rem 1.5rem;
        }

        .story-text h2, .section-header h2, .mv-card h2 {
            font-size: 1.8rem;
        }

        .story-text p, .section-header p, .mv-card p {
            font-size: 1rem;
        }

        .values-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .team-grid {
            grid-template-columns: 1fr;
        }

        .timeline-content {
            width: calc(100% - 80px);
        }

        .timeline-year {
            width: 60px;
            height: 60px;
            font-size: 1rem;
        }

        .stats-grid {
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
        .about-hero-content h1 {
            font-size: 1.8rem;
        }

        .about-hero-content p {
            font-size: 1rem;
        }

        .story-text h2, .section-header h2 {
            font-size: 1.6rem;
        }

        .value-card {
            padding: 2rem 1.5rem;
        }

        .team-image {
            height: 280px;
        }

        .stat-number {
            font-size: 2.5rem;
        }

        .btn {
            padding: 0.9rem 2rem;
            font-size: 0.95rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="about-hero">
    <div class="about-hero-content">
        <h1>Building Digital Excellence <span>Since 2018</span></h1>
        <p>We're a team of passionate innovators, designers, and developers dedicated to transforming ideas into exceptional digital experiences that make a real impact.</p>
    </div>
</section>

<!-- Our Story -->
<section class="our-story">
    <div class="story-content">
        <div class="team-card">
            <div class="team-image">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=500&fit=crop" alt="David Martinez">
                <div class="team-social">
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
            <div class="team-info">
                <h3>David Martinez</h3>
                <div class="team-role">Founder & CEO</div>
                <p>Visionary leader with 10+ years of experience in tech innovation and business strategy.</p>
            </div>
        </div>

        <div class="team-card">
            <div class="team-image">
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=500&fit=crop" alt="Sarah Johnson">
                <div class="team-social">
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
            <div class="team-info">
                <h3>Sarah Johnson</h3>
                <div class="team-role">CTO & Lead Developer</div>
                <p>Full-stack expert specializing in scalable solutions and cutting-edge technologies.</p>
            </div>
        </div>

        <div class="team-card">
            <div class="team-image">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=500&fit=crop" alt="Michael Chen">
                <div class="team-social">
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-dribbble"></i></a>
                    <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
            <div class="team-info">
                <h3>Michael Chen</h3>
                <div class="team-role">Creative Director</div>
                <p>Award-winning designer crafting beautiful and intuitive user experiences.</p>
            </div>
        </div>

        <div class="team-card">
            <div class="team-image">
                <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=400&h=500&fit=crop" alt="Emily Rodriguez">
                <div class="team-social">
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
            <div class="team-info">
                <h3>Emily Rodriguez</h3>
                <div class="team-role">AI Solutions Architect</div>
                <p>Machine learning expert developing intelligent systems that drive innovation.</p>
            </div>
        </div>

        <div class="team-card">
            <div class="team-image">
                <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&h=500&fit=crop" alt="James Wilson">
                <div class="team-social">
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                    <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
            <div class="team-info">
                <h3>James Wilson</h3>
                <div class="team-role">Senior Backend Developer</div>
                <p>Database guru and API specialist ensuring robust and secure applications.</p>
            </div>
        </div>

        <div class="team-card">
            <div class="team-image">
                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&h=500&fit=crop" alt="Lisa Anderson">
                <div class="team-social">
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
            <div class="team-info">
                <h3>Lisa Anderson</h3>
                <div class="team-role">Project Manager</div>
                <p>Organizational wizard ensuring projects deliver on time and exceed expectations.</p>
            </div>
        </div>
    </div>
</section>

<!-- Timeline -->
<section class="timeline-section">
    <div class="section-header">
        <h2>Our <span>Journey</span></h2>
        <p>Milestones that shaped our path to becoming a leading digital solutions provider</p>
    </div>
    <div class="timeline">
        <div class="timeline-item">
            <div class="timeline-year">2018</div>
            <div class="timeline-content">
                <h3>The Beginning</h3>
                <p>Horizon Tech Solution was founded with a mission to deliver innovative web solutions. Started with just 3 team members and a dream to make a difference.</p>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-year">2019</div>
            <div class="timeline-content">
                <h3>First Major Client</h3>
                <p>Secured our first enterprise client and successfully delivered a comprehensive e-commerce platform that increased their revenue by 200%.</p>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-year">2020</div>
            <div class="timeline-content">
                <h3>Team Expansion</h3>
                <p>Grew to 10 team members, expanded service offerings to include AI-powered solutions and mobile app development.</p>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-year">2021</div>
            <div class="timeline-content">
                <h3>Industry Recognition</h3>
                <p>Won "Best Emerging Tech Company" award and reached the milestone of 50 successful project deliveries.</p>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-year">2023</div>
            <div class="timeline-content">
                <h3>International Reach</h3>
                <p>Expanded operations internationally, serving clients across 15 countries and achieving ISO 9001 certification.</p>
            </div>
        </div>

        <div class="timeline-item">
            <div class="timeline-year">2025</div>
            <div class="timeline-content">
                <h3>Innovation Hub</h3>
                <p>Launched our AI Research Lab and reached 150+ projects delivered, 120+ happy clients, and a team of 15 experts.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-content">
        <h2>Ready to Work Together?</h2>
        <p>Let's create something amazing together. Join the 120+ businesses that trust us with their digital transformation journey.</p>
        <a href="contact.php" class="btn btn-primary">
            Get In Touch
            <i class="fas fa-arrow-right"></i>
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
    document.querySelectorAll('.section-header, .value-card, .stat-item, .cta-content, .team-card, .story-image, .story-text, .mv-card, .timeline-item').forEach(el => {
        observer.observe(el);
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
                animateCounter(counter);
                statsObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.stat-item').forEach(el => {
        statsObserver.observe(el);
    });

    // Stagger animation for value cards
    const valueCards = document.querySelectorAll('.value-card');
    valueCards.forEach((card, index) => {
        setTimeout(() => {
            observer.observe(card);
        }, index * 100);
    });

    // Stagger animation for team cards
    const teamCards = document.querySelectorAll('.team-card');
    teamCards.forEach((card, index) => {
        setTimeout(() => {
            observer.observe(card);
        }, index * 150);
    });

    // Stagger animation for timeline items
    const timelineItems = document.querySelectorAll('.timeline-item');
    timelineItems.forEach((item, index) => {
        setTimeout(() => {
            observer.observe(item);
        }, index * 200);
    });
</script>

<?php include 'includes/footer.php'; ?> 