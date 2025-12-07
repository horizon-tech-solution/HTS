<?php 
$pageTitle = "Our Services";
include 'includes/header.php'; 
?>

<style>
    /* Hero Section */
    .services-hero {
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

    .services-hero::before {
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

    .services-hero::after {
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

    .services-hero-content {
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

    .services-hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        color: var(--text-dark);
    }

    .services-hero-content h1 span {
        color: var(--primary-blue);
        position: relative;
        display: inline-block;
    }

    .services-hero-content p {
        font-size: 1.2rem;
        color: var(--text-gray);
        line-height: 1.8;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Services Grid */
    .services-grid-section {
        padding: 6rem 2rem;
        background: var(--white);
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

    .services-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 3rem;
    }

    .service-card {
        background: var(--white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
        border: 2px solid transparent;
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .service-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 102, 255, 0.15);
        border-color: var(--primary-blue);
    }

    .service-header {
        padding: 2.5rem 2.5rem 0;
        position: relative;
    }

    .service-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
        color: var(--white);
    }

    .service-card:hover .service-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .service-icon i {
        font-size: 2.2rem;
    }

    .service-header h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .service-header p {
        color: var(--text-gray);
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .service-body {
        padding: 0 2.5rem 2.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .service-features {
        list-style: none;
        margin-bottom: 2rem;
        flex-grow: 1;
    }

    .service-features li {
        margin-bottom: 0.8rem;
        display: flex;
        align-items: flex-start;
        gap: 0.8rem;
    }

    .service-features i {
        color: var(--primary-blue);
        font-size: 1rem;
        margin-top: 0.2rem;
        flex-shrink: 0;
    }

    .service-features span {
        color: var(--text-gray);
        line-height: 1.6;
    }

    .service-link {
        color: var(--primary-blue);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: gap 0.3s ease;
        margin-top: auto;
        padding: 0.5rem 0;
    }

    .service-link:hover {
        gap: 1rem;
    }

    /* Service Details */
    .service-details {
        padding: 6rem 2rem;
        background: var(--light-blue);
    }

    .details-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 4rem;
    }

    .detail-card {
        background: var(--white);
        padding: 3rem;
        border-radius: 20px;
        text-align: center;
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
        box-shadow: 0 10px 40px rgba(0, 102, 255, 0.1);
        border: 2px solid transparent;
    }

    .detail-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .detail-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 50px rgba(0, 102, 255, 0.15);
        border-color: var(--primary-blue);
    }

    .detail-icon {
        width: 70px;
        height: 70px;
        background: var(--light-blue);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        transition: all 0.3s ease;
    }

    .detail-card:hover .detail-icon {
        background: var(--primary-blue);
        transform: scale(1.1);
    }

    .detail-icon i {
        font-size: 2rem;
        color: var(--primary-blue);
        transition: color 0.3s ease;
    }

    .detail-card:hover .detail-icon i {
        color: var(--white);
    }

    .detail-card h3 {
        font-size: 1.4rem;
        margin-bottom: 1rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .detail-card p {
        color: var(--text-gray);
        line-height: 1.7;
        font-size: 0.95rem;
    }

    /* Process Section */
    .process-section {
        padding: 6rem 2rem;
        background: var(--white);
    }

    .process-steps {
        max-width: 1200px;
        margin: 3rem auto 0;
        position: relative;
    }

    .process-steps::before {
        content: '';
        position: absolute;
        top: 60px;
        left: 50%;
        transform: translateX(-50%);
        width: 80%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        z-index: 1;
    }

    .process-step {
        position: relative;
        margin-bottom: 4rem;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
        display: flex;
        align-items: flex-start;
        gap: 3rem;
    }

    .process-step.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .step-number {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 2.5rem;
        font-weight: 800;
        flex-shrink: 0;
        position: relative;
        z-index: 2;
        box-shadow: 0 10px 30px rgba(0, 102, 255, 0.3);
    }

    .step-content {
        flex-grow: 1;
        padding-top: 1.5rem;
    }

    .step-content h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .step-content p {
        color: var(--text-gray);
        line-height: 1.7;
    }

    /* Pricing Section */
    .pricing-section {
        padding: 6rem 2rem;
        background: var(--light-blue);
    }

    .pricing-grid {
        max-width: 1400px;
        margin: 3rem auto 0;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2.5rem;
    }

    .pricing-card {
        background: var(--white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
        border: 2px solid var(--border-color);
        position: relative;
    }

    .pricing-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 102, 255, 0.15);
        border-color: var(--primary-blue);
    }

    .pricing-card.popular {
        border-color: var(--primary-blue);
        transform: scale(1.05);
    }

    .pricing-card.popular:hover {
        transform: scale(1.05) translateY(-10px);
    }

    .popular-tag {
        position: absolute;
        top: 20px;
        right: 20px;
        background: var(--primary-blue);
        color: var(--white);
        padding: 0.3rem 1rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .pricing-header {
        padding: 2.5rem;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
    }

    .pricing-header h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .price {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--primary-blue);
        margin-bottom: 0.5rem;
    }

    .price span {
        font-size: 1rem;
        font-weight: 500;
        color: var(--text-gray);
    }

    .pricing-header p {
        color: var(--text-gray);
        font-size: 0.95rem;
    }

    .pricing-features {
        padding: 2.5rem;
        list-style: none;
    }

    .pricing-features li {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .pricing-features i {
        color: var(--primary-blue);
        font-size: 1rem;
    }

    .pricing-features span {
        color: var(--text-gray);
        font-size: 0.95rem;
    }

    .pricing-cta {
        padding: 0 2.5rem 2.5rem;
        text-align: center;
    }

    .btn {
        padding: 1rem 2.5rem;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        font-size: 1rem;
        width: 100%;
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

    .btn-secondary {
        background: transparent;
        color: var(--primary-blue);
        border: 2px solid var(--primary-blue);
    }

    .btn-secondary:hover {
        background: var(--primary-blue);
        color: var(--white);
        transform: translateY(-3px);
    }

    /* FAQ Section */
    .faq-section {
        padding: 6rem 2rem;
        background: var(--white);
    }

    .faq-grid {
        max-width: 1000px;
        margin: 3rem auto 0;
    }

    .faq-item {
        margin-bottom: 1.5rem;
        border: 2px solid var(--border-color);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(20px);
    }

    .faq-item.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .faq-item.active {
        border-color: var(--primary-blue);
        box-shadow: 0 10px 30px rgba(0, 102, 255, 0.1);
    }

    .faq-question {
        padding: 1.5rem 2rem;
        background: var(--white);
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .faq-item.active .faq-question {
        background: var(--light-blue);
    }

    .faq-question h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin: 0;
    }

    .faq-icon {
        color: var(--primary-blue);
        font-size: 1.2rem;
        transition: transform 0.3s ease;
    }

    .faq-item.active .faq-icon {
        transform: rotate(180deg);
    }

    .faq-answer {
        padding: 0 2rem;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-item.active .faq-answer {
        padding: 0 2rem 1.5rem;
        max-height: 500px;
    }

    .faq-answer p {
        color: var(--text-gray);
        line-height: 1.7;
        margin: 0;
    }

    /* CTA Section */
    .cta-section {
        padding: 6rem 2rem;
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        color: var(--white);
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
    }

    .cta-content p {
        font-size: 1.2rem;
        opacity: 0.95;
        margin-bottom: 2.5rem;
        line-height: 1.8;
    }

    .cta-btn {
        background: var(--white);
        color: var(--primary-blue);
        border: 2px solid var(--white);
    }

    .cta-btn:hover {
        background: transparent;
        color: var(--white);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .process-steps::before {
            display: none;
        }

        .process-step {
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 1.5rem;
        }
    }

    @media (max-width: 968px) {
        .services-hero-content h1 {
            font-size: 2.8rem;
        }

        .services-grid {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .section-header h2 {
            font-size: 2.2rem;
        }

        .pricing-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .pricing-card.popular {
            transform: none;
        }

        .pricing-card.popular:hover {
            transform: translateY(-10px);
        }
    }

    @media (max-width: 768px) {
        .services-hero {
            min-height: 50vh;
            margin-top: 70px;
            padding: 3rem 1.5rem;
        }

        .services-hero-content h1 {
            font-size: 2.2rem;
        }

        .services-hero-content p {
            font-size: 1.1rem;
        }

        .services-grid-section, .service-details, .process-section, .pricing-section, .faq-section, .cta-section {
            padding: 3rem 1.5rem;
        }

        .services-grid {
            grid-template-columns: 1fr;
        }

        .service-header, .service-body {
            padding: 2rem;
        }

        .detail-card {
            padding: 2rem;
        }

        .step-number {
            width: 100px;
            height: 100px;
            font-size: 2rem;
        }

        .section-header h2, .cta-content h2 {
            font-size: 1.8rem;
        }

        .section-header p, .cta-content p {
            font-size: 1rem;
        }

        .price {
            font-size: 2.8rem;
        }

        .pricing-header, .pricing-features, .pricing-cta {
            padding: 2rem;
        }

        .faq-question {
            padding: 1.25rem 1.5rem;
        }

        .faq-question h3 {
            font-size: 1rem;
        }

        .btn {
            padding: 0.9rem 2rem;
            font-size: 0.95rem;
        }
    }

    @media (max-width: 480px) {
        .services-hero-content h1 {
            font-size: 1.8rem;
        }

        .services-hero-content p {
            font-size: 1rem;
        }

        .section-header h2 {
            font-size: 1.6rem;
        }

        .service-icon {
            width: 70px;
            height: 70px;
        }

        .service-icon i {
            font-size: 2rem;
        }

        .service-header h3 {
            font-size: 1.3rem;
        }

        .detail-card {
            padding: 1.5rem;
        }

        .step-number {
            width: 80px;
            height: 80px;
            font-size: 1.8rem;
        }

        .price {
            font-size: 2.2rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="services-hero">
    <div class="services-hero-content">
        <h1>Comprehensive <span>Digital Solutions</span></h1>
        <p>From concept to deployment, we provide end-to-end digital services that transform businesses and deliver measurable results.</p>
    </div>
</section>

<!-- Services Grid -->
<section class="services-grid-section" id="services">
    <div class="section-header">
        <h2>Our <span>Services</span></h2>
        <p>We offer a complete suite of digital services designed to meet the unique needs of modern businesses</p>
    </div>
    
    <div class="services-grid">
        <!-- Website Development -->
        <div class="service-card" id="web">
            <div class="service-header">
                <div class="service-icon">
                    <i class="fas fa-laptop-code"></i>
                </div>
                <h3>Website Development</h3>
                <p>Create stunning, responsive websites that engage visitors and drive conversions with modern design and optimal performance.</p>
            </div>
            <div class="service-body">
                <ul class="service-features">
                    <li><i class="fas fa-check"></i><span>Responsive design for all devices</span></li>
                    <li><i class="fas fa-check"></i><span>SEO optimization and fast loading</span></li>
                    <li><i class="fas fa-check"></i><span>Content Management Systems</span></li>
                    <li><i class="fas fa-check"></i><span>E-commerce integration</span></li>
                    <li><i class="fas fa-check"></i><span>Ongoing maintenance & support</span></li>
                </ul>
                <a href="#contact" class="service-link">
                    Get Started
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Web Applications -->
        <div class="service-card" id="webapp">
            <div class="service-header">
                <div class="service-icon">
                    <i class="fas fa-window-restore"></i>
                </div>
                <h3>Web Applications</h3>
                <p>Build powerful, scalable web applications that streamline operations and enhance user experience for businesses of all sizes.</p>
            </div>
            <div class="service-body">
                <ul class="service-features">
                    <li><i class="fas fa-check"></i><span>Custom web application development</span></li>
                    <li><i class="fas fa-check"></i><span>API development & integration</span></li>
                    <li><i class="fas fa-check"></i><span>Real-time features & updates</span></li>
                    <li><i class="fas fa-check"></i><span>Database design & optimization</span></li>
                    <li><i class="fas fa-check"></i><span>Security & performance testing</span></li>
                </ul>
                <a href="#contact" class="service-link">
                    Get Started
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- AI Solutions -->
        <div class="service-card" id="ai">
            <div class="service-header">
                <div class="service-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h3>AI-Powered Systems</h3>
                <p>Leverage artificial intelligence and machine learning to automate processes and gain valuable insights from your data.</p>
            </div>
            <div class="service-body">
                <ul class="service-features">
                    <li><i class="fas fa-check"></i><span>Machine learning models</span></li>
                    <li><i class="fas fa-check"></i><span>Predictive analytics</span></li>
                    <li><i class="fas fa-check"></i><span>Natural language processing</span></li>
                    <li><i class="fas fa-check"></i><span>Computer vision solutions</span></li>
                    <li><i class="fas fa-check"></i><span>AI automation systems</span></li>
                </ul>
                <a href="#contact" class="service-link">
                    Get Started
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Graphics Design -->
        <div class="service-card" id="design">
            <div class="service-header">
                <div class="service-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <h3>Graphics Design</h3>
                <p>Create compelling visual designs that capture attention and effectively communicate your brand message across all platforms.</p>
            </div>
            <div class="service-body">
                <ul class="service-features">
                    <li><i class="fas fa-check"></i><span>Brand identity design</span></li>
                    <li><i class="fas fa-check"></i><span>UI/UX design</span></li>
                    <li><i class="fas fa-check"></i><span>Marketing materials</span></li>
                    <li><i class="fas fa-check"></i><span>Social media graphics</span></li>
                    <li><i class="fas fa-check"></i><span>Print & digital assets</span></li>
                </ul>
                <a href="#contact" class="service-link">
                    Get Started
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- SEO & Marketing -->
        <div class="service-card" id="seo">
            <div class="service-header">
                <div class="service-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>SEO & Digital Marketing</h3>
                <p>Boost your online visibility and drive targeted traffic with comprehensive SEO and digital marketing strategies.</p>
            </div>
            <div class="service-body">
                <ul class="service-features">
                    <li><i class="fas fa-check"></i><span>Search engine optimization</span></li>
                    <li><i class="fas fa-check"></i><span>Content marketing strategy</span></li>
                    <li><i class="fas fa-check"></i><span>Social media management</span></li>
                    <li><i class="fas fa-check"></i><span>PPC campaign management</span></li>
                    <li><i class="fas fa-check"></i><span>Analytics & reporting</span></li>
                </ul>
                <a href="#contact" class="service-link">
                    Get Started
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Mobile Apps -->
        <div class="service-card" id="mobile">
            <div class="service-header">
                <div class="service-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h3>Mobile Applications</h3>
                <p>Develop intuitive and powerful mobile applications for iOS and Android that engage users and drive business growth.</p>
            </div>
            <div class="service-body">
                <ul class="service-features">
                    <li><i class="fas fa-check"></i><span>iOS & Android development</span></li>
                    <li><i class="fas fa-check"></i><span>Cross-platform apps</span></li>
                    <li><i class="fas fa-check"></i><span>Push notifications</span></li>
                    <li><i class="fas fa-check"></i><span>App store optimization</span></li>
                    <li><i class="fas fa-check"></i><span>Maintenance & updates</span></li>
                </ul>
                <a href="#contact" class="service-link">
                    Get Started
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Service Details -->
<section class="service-details">
    <div class="section-header">
        <h2>Why Choose <span>Our Services</span></h2>
        <p>We combine technical expertise with strategic thinking to deliver solutions that drive real business impact</p>
    </div>
    <div class="details-grid">
        <div class="detail-card">
            <div class="detail-icon">
                <i class="fas fa-cogs"></i>
            </div>
            <h3>Custom Solutions</h3>
            <p>We don't believe in one-size-fits-all. Every solution is tailored to your specific business needs and goals.</p>
        </div>

        <div class="detail-card">
            <div class="detail-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Security First</h3>
            <p>Your data and applications are protected with enterprise-grade security measures and best practices.</p>
        </div>

        <div class="detail-card">
            <div class="detail-icon">
                <i class="fas fa-headset"></i>
            </div>
            <h3>24/7 Support</h3>
            <p>Our dedicated support team is always available to ensure your systems run smoothly around the clock.</p>
        </div>

        <div class="detail-card">
            <div class="detail-icon">
                <i class="fas fa-rocket"></i>
            </div>
            <h3>Fast Delivery</h3>
            <p>We follow agile methodologies to deliver projects on time without compromising quality or performance.</p>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="process-section">
    <div class="section-header">
        <h2>Our <span>Service Process</span></h2>
        <p>A proven methodology that ensures successful project delivery and client satisfaction</p>
    </div>
    <div class="process-steps">
        <div class="process-step">
            <div class="step-number">1</div>
            <div class="step-content">
                <h3>Discovery & Planning</h3>
                <p>We begin by thoroughly understanding your business goals, target audience, and requirements to create a detailed project roadmap and strategy.</p>
            </div>
        </div>

        <div class="process-step">
            <div class="step-number">2</div>
            <div class="step-content">
                <h3>Design & Prototyping</h3>
                <p>Our creative team designs user-centric interfaces and creates interactive prototypes for your review and feedback before development begins.</p>
            </div>
        </div>

        <div class="process-step">
            <div class="step-number">3</div>
            <div class="step-content">
                <h3>Development & Testing</h3>
                <p>Using modern technologies and agile methodologies, we build robust solutions while continuously testing for quality, performance, and security.</p>
            </div>
        </div>

        <div class="process-step">
            <div class="step-number">4</div>
            <div class="step-content">
                <h3>Launch & Support</h3>
                <p>We deploy your solution, provide training and documentation, and offer ongoing support to ensure long-term success and optimization.</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="pricing-section">
    <div class="section-header">
        <h2>Flexible <span>Pricing Plans</span></h2>
        <p>Choose the plan that best fits your business needs and budget requirements</p>
    </div>
    <div class="pricing-grid">
        <div class="pricing-card">
            <div class="pricing-header">
                <h3>Basic</h3>
                <div class="price">$999<span>/project</span></div>
                <p>Perfect for small businesses & startups</p>
            </div>
            <ul class="pricing-features">
                <li><i class="fas fa-check"></i><span>5-10 Page Website</span></li>
                <li><i class="fas fa-check"></i><span>Responsive Design</span></li>
                <li><i class="fas fa-check"></i><span>Basic SEO Setup</span></li>
                <li><i class="fas fa-check"></i><span>30 Days Support</span></li>
                <li><i class="fas fa-times"></i><span>E-commerce Features</span></li>
                <li><i class="fas fa-times"></i><span>Custom Development</span></li>
            </ul>
            <div class="pricing-cta">
                <a href="#contact" class="btn btn-primary">Get Started</a>
            </div>
        </div>

        <div class="pricing-card popular">
            <div class="popular-tag">Most Popular</div>
            <div class="pricing-header">
                <h3>Professional</h3>
                <div class="price">$2,499<span>/project</span></div>
                <p>Ideal for growing businesses</p>
            </div>
            <ul class="pricing-features">
                <li><i class="fas fa-check"></i><span>10-20 Page Website</span></li>
                <li><i class="fas fa-check"></i><span>Advanced Features</span></li>
                <li><i class="fas fa-check"></i><span>E-commerce Integration</span></li>
                <li><i class="fas fa-check"></i><span>90 Days Support</span></li>
                <li><i class="fas fa-check"></i><span>SEO Optimization</span></li>
                <li><i class="fas fa-check"></i><span>Custom Design</span></li>
            </ul>
            <div class="pricing-cta">
                <a href="#contact" class="btn btn-primary">Get Started</a>
            </div>
        </div>

        <div class="pricing-card">
            <div class="pricing-header">
                <h3>Enterprise</h3>
                <div class="price">$4,999<span>/project</span></div>
                <p>For large-scale solutions</p>
            </div>
            <ul class="pricing-features">
                <li><i class="fas fa-check"></i><span>Custom Web Application</span></li>
                <li><i class="fas fa-check"></i><span>Advanced Analytics</span></li>
                <li><i class="fas fa-check"></i><span>AI Integration</span></li>
                <li><i class="fas fa-check"></i><span>6 Months Support</span></li>
                <li><i class="fas fa-check"></i><span>Dedicated Project Manager</span></li>
                <li><i class="fas fa-check"></i><span>Priority Support</span></li>
            </ul>
            <div class="pricing-cta">
                <a href="#contact" class="btn btn-primary">Get Started</a>
            </div>
        </div>
    </div>
    <div style="text-align: center; margin-top: 3rem;">
        <p style="color: var(--text-gray); font-size: 0.95rem;">Custom pricing available for specific requirements. <a href="#contact" style="color: var(--primary-blue); font-weight: 600; text-decoration: none;">Contact us</a> for a personalized quote.</p>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="section-header">
        <h2>Frequently Asked <span>Questions</span></h2>
        <p>Find answers to common questions about our services and processes</p>
    </div>
    <div class="faq-grid">
        <div class="faq-item">
            <div class="faq-question">
                <h3>What's included in your website development service?</h3>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>Our website development service includes responsive design, SEO optimization, content management system setup, hosting configuration, basic training, and 30 days of technical support. We also provide performance optimization and security implementation.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>How long does it take to complete a typical project?</h3>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>Project timelines vary based on complexity. A basic website typically takes 2-4 weeks, web applications 4-8 weeks, and enterprise solutions 8-12 weeks. We provide detailed timelines during the discovery phase and maintain regular progress updates throughout the project.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Do you offer ongoing maintenance and support?</h3>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>Yes, we offer comprehensive maintenance packages including regular updates, security patches, performance monitoring, and 24/7 technical support. We provide flexible plans ranging from basic monitoring to full-service management based on your needs.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>Can you work with our existing systems and platforms?</h3>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>Absolutely. We have extensive experience integrating with various platforms, APIs, and third-party services. Whether you need to connect with existing CRM, ERP, or custom systems, we ensure seamless integration while maintaining data integrity and security.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>What technologies do you specialize in?</h3>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>We work with a wide range of modern technologies including React, Vue.js, Angular, Node.js, Python, PHP/Laravel, .NET, WordPress, and various databases. For AI solutions, we use TensorFlow, PyTorch, and custom machine learning frameworks.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <h3>How do you ensure project quality and success?</h3>
                <i class="fas fa-chevron-down faq-icon"></i>
            </div>
            <div class="faq-answer">
                <p>We follow agile methodologies with regular testing, code reviews, and client feedback sessions. Our quality assurance process includes performance testing, security audits, and user acceptance testing. We also provide transparent project management with regular progress reports.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" id="contact">
    <div class="cta-content">
        <h2>Ready to Transform Your Business?</h2>
        <p>Let's discuss how our digital solutions can help you achieve your goals and drive growth for your organization.</p>
        <a href="contact.php" class="btn cta-btn">
            Start Your Project Today
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
    document.querySelectorAll('.section-header, .service-card, .detail-card, .process-step, .pricing-card, .faq-item, .cta-content').forEach(el => {
        observer.observe(el);
    });

    // FAQ Accordion Functionality
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            // Close other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item && otherItem.classList.contains('active')) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle current item
            item.classList.toggle('active');
        });
    });

    // Smooth scroll for service links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href !== '#!') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // Stagger animation for service cards
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach((card, index) => {
        setTimeout(() => {
            observer.observe(card);
        }, index * 100);
    });

    // Stagger animation for detail cards
    const detailCards = document.querySelectorAll('.detail-card');
    detailCards.forEach((card, index) => {
        setTimeout(() => {
            observer.observe(card);
        }, index * 150);
    });

    // Stagger animation for pricing cards
    const pricingCards = document.querySelectorAll('.pricing-card');
    pricingCards.forEach((card, index) => {
        setTimeout(() => {
            observer.observe(card);
        }, index * 200);
    });

    // Stagger animation for FAQ items
    const allFaqItems = document.querySelectorAll('.faq-item');
    allFaqItems.forEach((item, index) => {
        setTimeout(() => {
            observer.observe(item);
        }, index * 100);
    });
</script>

<?php include 'includes/footer.php'; ?>