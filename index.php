<?php 
$pageTitle = "Home";
include 'includes/header.php'; 
?>

<style>
    /* Hero Section */
    .hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #E6F0FF 0%, #FFFFFF 50%, #E6F0FF 100%);
        position: relative;
        overflow: hidden;
        padding: 0 2rem;
        margin-top: 80px;
    }

    .hero::before {
        content: '';
        position: absolute;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(0, 102, 255, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        top: -200px;
        right: -200px;
        animation: float 20s ease-in-out infinite;
    }

    .hero::after {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(0, 71, 171, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        bottom: -150px;
        left: -150px;
        animation: float 15s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(30px, -30px) rotate(5deg); }
        50% { transform: translate(-20px, 20px) rotate(-5deg); }
        75% { transform: translate(20px, 10px) rotate(3deg); }
    }

    .hero-content {
        max-width: 1400px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .hero-text {
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

    .hero-text h1 {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        color: var(--text-dark);
    }

    .hero-text h1 span {
        color: var(--primary-blue);
        position: relative;
        display: inline-block;
    }

    .hero-text h1 span::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 0;
        width: 100%;
        height: 12px;
        background: rgba(0, 102, 255, 0.2);
        z-index: -1;
        border-radius: 3px;
    }

    .hero-text p {
        font-size: 1.2rem;
        color: var(--text-gray);
        line-height: 1.8;
        margin-bottom: 2.5rem;
    }

    .hero-buttons {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
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

    .btn-secondary {
        background: transparent;
        color: var(--primary-blue);
        border: 2px solid var(--primary-blue);
    }

    .btn-secondary:hover {
        background: var(--primary-blue);
        color: var(--white);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(0, 102, 255, 0.2);
    }

    .hero-image {
        position: relative;
        opacity: 0;
        animation: fadeInUp 1s ease 0.3s forwards;
    }

    .hero-image img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 102, 255, 0.2);
        transition: transform 0.3s ease;
    }

    .hero-image:hover img {
        transform: scale(1.02);
    }

    /* Trust Badges */
    .trust-badges {
        padding: 3rem 2rem;
        background: var(--white);
        border-bottom: 1px solid var(--border-color);
    }

    .trust-content {
        max-width: 1400px;
        margin: 0 auto;
        text-align: center;
    }

    .trust-content p {
        color: var(--text-gray);
        font-size: 0.95rem;
        margin-bottom: 2rem;
        font-weight: 500;
    }

    .badges-grid {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 3rem;
        flex-wrap: wrap;
    }

    .badge {
        font-size: 1.1rem;
        color: var(--text-gray);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .badge:hover {
        opacity: 1;
    }

    .badge i {
        color: var(--primary-blue);
        font-size: 1.4rem;
    }

    /* Services Section */
    .services {
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
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2.5rem;
    }

    .service-card {
        background: var(--white);
        padding: 2.5rem;
        border-radius: 20px;
        border: 2px solid var(--border-color);
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
        position: relative;
        overflow: hidden;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-blue), var(--dark-blue));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .service-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 102, 255, 0.15);
        border-color: var(--primary-blue);
    }

    .service-card:hover::before {
        transform: scaleX(1);
    }

    .service-icon {
        width: 70px;
        height: 70px;
        background: var(--light-blue);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .service-icon i {
        font-size: 2rem;
        color: var(--primary-blue);
        transition: transform 0.3s ease;
    }

    .service-card:hover .service-icon {
        background: var(--primary-blue);
        transform: scale(1.1);
    }

    .service-card:hover .service-icon i {
        color: var(--white);
        transform: rotateY(360deg);
    }

    .service-card h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .service-card p {
        color: var(--text-gray);
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .service-link {
        color: var(--primary-blue);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: gap 0.3s ease;
    }

    .service-link:hover {
        gap: 1rem;
    }

    /* Why Choose Us */
    .why-choose {
        padding: 6rem 2rem;
        background: var(--light-blue);
    }

    .why-content {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5rem;
        align-items: center;
    }

    .why-image {
        position: relative;
        opacity: 0;
        transform: translateX(-30px);
        transition: all 0.6s ease;
    }

    .why-image.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .why-image img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 102, 255, 0.2);
    }

    .why-text {
        opacity: 0;
        transform: translateX(30px);
        transition: all 0.6s ease;
    }

    .why-text.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .why-text h2 {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        color: var(--text-dark);
    }

    .why-text h2 span {
        color: var(--primary-blue);
    }

    .why-text > p {
        font-size: 1.1rem;
        color: var(--text-gray);
        line-height: 1.8;
        margin-bottom: 2.5rem;
    }

    .features-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .feature-item {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        background: var(--white);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border: 2px solid var(--border-color);
    }

    .feature-icon i {
        color: var(--primary-blue);
        font-size: 1.3rem;
    }

    .feature-content h4 {
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .feature-content p {
        color: var(--text-gray);
        line-height: 1.7;
    }

    /* Process Section */
    .process {
        padding: 6rem 2rem;
        background: var(--white);
    }

    .process-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 3rem;
        margin-top: 3rem;
    }

    .process-step {
        text-align: center;
        position: relative;
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }

    .process-step.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .step-number {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
        color: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 800;
        margin: 0 auto 1.5rem;
        position: relative;
        box-shadow: 0 10px 30px rgba(0, 102, 255, 0.3);
    }

    .step-number::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border: 3px solid var(--primary-blue);
        border-radius: 50%;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.2);
            opacity: 0;
        }
    }

    .process-step h3 {
        font-size: 1.4rem;
        margin-bottom: 1rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .process-step p {
        color: var(--text-gray);
        line-height: 1.7;
    }

    /* Portfolio Preview */
    .portfolio-preview {
        padding: 6rem 2rem;
        background: var(--light-blue);
    }

    .portfolio-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2.5rem;
        margin-top: 3rem;
    }

    .portfolio-card {
        background: var(--white);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
        border: 2px solid transparent;
    }

    .portfolio-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .portfolio-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 60px rgba(0, 102, 255, 0.15);
        border-color: var(--primary-blue);
    }

    .portfolio-image {
        width: 100%;
        height: 250px;
        overflow: hidden;
        position: relative;
    }

    .portfolio-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .portfolio-card:hover .portfolio-image img {
        transform: scale(1.1);
    }

    .portfolio-overlay {
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

    .portfolio-card:hover .portfolio-overlay {
        opacity: 1;
    }

    .portfolio-overlay i {
        color: var(--white);
        font-size: 2.5rem;
    }

    .portfolio-info {
        padding: 2rem;
    }

    .portfolio-category {
        color: var(--primary-blue);
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    .portfolio-info h3 {
        font-size: 1.4rem;
        margin-bottom: 0.8rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .portfolio-info p {
        color: var(--text-gray);
        line-height: 1.7;
    }

    .view-all-btn {
        text-align: center;
        margin-top: 3rem;
    }

    /* Testimonials */
    .testimonials {
        padding: 6rem 2rem;
        background: var(--white);
    }

    .testimonials-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem;
        margin-top: 3rem;
    }

    .testimonial-card {
        background: var(--white);
        padding: 2.5rem;
        border-radius: 20px;
        border: 2px solid var(--border-color);
        position: relative;
        transition: all 0.4s ease;
        opacity: 0;
        transform: translateY(30px);
    }

    .testimonial-card.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 102, 255, 0.1);
        border-color: var(--primary-blue);
    }

    .quote-icon {
        font-size: 3rem;
        color: var(--primary-blue);
        opacity: 0.2;
        margin-bottom: 1rem;
    }

    .testimonial-text {
        color: var(--text-gray);
        line-height: 1.8;
        margin-bottom: 2rem;
        font-style: italic;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .author-image {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid var(--light-blue);
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

    .rating {
        color: #FFB800;
        margin-bottom: 1rem;
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

    /* Technologies */
    .technologies {
        padding: 6rem 2rem;
        background: var(--white);
    }

    .tech-grid {
        max-width: 1400px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .tech-item {
        text-align: center;
        padding: 2rem;
        border-radius: 15px;
        background: var(--light-blue);
        transition: all 0.3s ease;
        opacity: 0;
        transform: scale(0.9);
        border: 2px solid transparent;
    }

    .tech-item.visible {
        opacity: 1;
        transform: scale(1);
    }

    .tech-item:hover {
        background: var(--white);
        border-color: var(--primary-blue);
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 102, 255, 0.1);
    }

    .tech-item i {
        font-size: 3rem;
        color: var(--primary-blue);
        margin-bottom: 1rem;
    }

    .tech-item h4 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
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

    /* Responsive */
    @media (max-width: 1200px) {
        .hero-content, .why-content {
            gap: 3rem;
        }

        .hero-text h1 {
            font-size: 3rem;
        }
    }

    @media (max-width: 968px) {
        .hero-content, .why-content {
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }

        .why-image {
            order: 2;
        }

        .why-text {
            order: 1;
        }

        .hero-text h1, .why-text h2 {
            font-size: 2.5rem;
        }

        .hero-text p, .why-text > p {
            font-size: 1.05rem;
        }

        .section-header h2 {
            font-size: 2.2rem;
        }

        .section-header p {
            font-size: 1rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .stat-number {
            font-size: 2.8rem;
        }

        .portfolio-grid {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        .services-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .tech-grid {
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .hero {
            padding: 0 1.5rem;
            margin-top: 70px;
            min-height: auto;
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .hero-text h1, .why-text h2 {
            font-size: 2rem;
            line-height: 1.3;
        }

        .cta-content h2 {
            font-size: 1.8rem;
        }

        .hero-text p, .why-text > p, .cta-content p {
            font-size: 1rem;
        }

        .hero-buttons {
            flex-direction: column;
            width: 100%;
        }

        .btn {
            justify-content: center;
            width: 100%;
            padding: 0.9rem 2rem;
        }

        .services, .why-choose, .process, .portfolio-preview, .testimonials, .technologies, .cta-section {
            padding: 3rem 1.5rem;
        }

        .trust-badges {
            padding: 2rem 1.5rem;
        }

        .stats {
            padding: 3rem 1.5rem;
        }

        .services-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .section-header {
            margin-bottom: 2.5rem;
        }

        .section-header h2 {
            font-size: 1.8rem;
        }

        .section-header p {
            font-size: 0.95rem;
        }

        .process-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .tech-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        .tech-item {
            padding: 1.5rem 1rem;
        }

        .tech-item i {
            font-size: 2.5rem;
        }

        .testimonials-grid {
            grid-template-columns: 1fr;
        }

        .portfolio-grid {
            grid-template-columns: 1fr;
        }

        .badges-grid {
            gap: 1.5rem;
            flex-direction: column;
            align-items: center;
        }

        .badge {
            font-size: 0.9rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .stat-number {
            font-size: 2.5rem;
        }

        .stat-label {
            font-size: 1rem;
        }

        .service-card, .testimonial-card {
            padding: 2rem;
        }

        .service-card h3, .portfolio-info h3 {
            font-size: 1.3rem;
        }

        .features-list {
            gap: 1.2rem;
        }

        .feature-icon {
            width: 45px;
            height: 45px;
        }

        .feature-content h4 {
            font-size: 1.1rem;
        }

        .step-number {
            width: 70px;
            height: 70px;
            font-size: 1.8rem;
        }

        .process-step h3 {
            font-size: 1.2rem;
        }

        .portfolio-image {
            height: 200px;
        }

        .view-all-btn {
            margin-top: 2rem;
        }
    }

    @media (max-width: 480px) {
        .hero-text h1 {
            font-size: 1.75rem;
        }

        .section-header h2, .why-text h2, .cta-content h2 {
            font-size: 1.6rem;
        }

        .hero-text p, .section-header p {
            font-size: 0.95rem;
        }

        .service-icon {
            width: 60px;
            height: 60px;
        }

        .service-icon i {
            font-size: 1.8rem;
        }

        .tech-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .stat-number {
            font-size: 2.2rem;
        }

        .process-step {
            text-align: center;
        }

        .step-number {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }

        .testimonial-card {
            padding: 1.5rem;
        }

        .author-image {
            width: 50px;
            height: 50px;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            font-size: 0.95rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Building <span>Digital Solutions</span> for Tomorrow</h1>
            <p>Transform your business with cutting-edge technology. From stunning websites to AI-powered systems, we deliver innovation that drives results and helps you stay ahead in the digital age.</p>
            <div class="hero-buttons">
                <a href="contact.php" class="btn btn-primary">
                    Get Started
                    <i class="fas fa-arrow-right"></i>
                </a>
                <a href="projects.php" class="btn btn-secondary">
                    View Projects
                    <i class="fas fa-folder-open"></i>
                </a>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?w=800&h=600&fit=crop" alt="Technology workspace">
        </div>
    </div>
</section>

<!-- Trust Badges -->
<section class="trust-badges">
    <div class="trust-content">
        <p>TRUSTED BY INNOVATIVE COMPANIES WORLDWIDE</p>
        <div class="badges-grid">
            <div class="badge">
                <i class="fas fa-check-circle"></i>
                <span>ISO Certified</span>
            </div>
            <div class="badge">
                <i class="fas fa-award"></i>
                <span>Award Winning</span>
            </div>
            <div class="badge">
                <i class="fas fa-users"></i>
                <span>120+ Clients</span>
            </div>
            <div class="badge">
                <i class="fas fa-shield-alt"></i>
                <span>Secure & Reliable</span>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services">
    <div class="section-header">
        <h2>Our <span>Services</span></h2>
        <p>We offer comprehensive digital solutions tailored to elevate your business in the modern world</p>
    </div>
    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-laptop-code"></i>
            </div>
            <h3>Website Development</h3>
            <p>Custom, responsive websites built with modern technologies. Fast, secure, and optimized for performance across all devices and browsers.</p>
            <a href="services.php#web" class="service-link">
                Learn More
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-window-restore"></i>
            </div>
            <h3>Web Applications</h3>
            <p>Powerful web apps that streamline operations and enhance user experience. Built with scalability and security in mind.</p>
            <a href="services.php#webapp" class="service-link">
                Learn More
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-brain"></i>
            </div>
            <h3>AI-Powered Systems</h3>
            <p>Intelligent solutions leveraging machine learning and AI to automate processes and deliver data-driven insights for your business.</p>
            <a href="services.php#ai" class="service-link">
                Learn More
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-palette"></i>
            </div>
            <h3>Graphics Design</h3>
            <p>Creative visual designs that capture attention and communicate your brand message effectively across all platforms.</p>
            <a href="services.php#design" class="service-link">
                Learn More
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-choose">
    <div class="why-content">
        <div class="why-image">
            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=600&fit=crop" alt="Team collaboration">
        </div>
        <div class="why-text">
            <h2>Why Choose <span>Horizon Tech?</span></h2>
            <p>We combine technical expertise with creative innovation to deliver solutions that drive real business results. Our commitment to excellence and customer satisfaction sets us apart.</p>
            
            <div class="features-list">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Fast Delivery</h4>
                        <p>We deliver projects on time without compromising quality. Our agile methodology ensures rapid development cycles.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Clean Code</h4>
                        <p>We write maintainable, scalable code following industry best practices and standards for long-term success.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="feature-content">
                        <h4>24/7 Support</h4>
                        <p>Our dedicated support team is always available to help you with any questions or technical issues.</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="feature-content">
                        <h4>Results Driven</h4>
                        <p>We focus on delivering measurable results that contribute directly to your business growth and success.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="process">
    <div class="section-header">
        <h2>Our <span>Process</span></h2>
        <p>A streamlined approach to bring your ideas to life efficiently and effectively</p>
    </div>
    <div class="process-grid">
        <div class="process-step">
            <div class="step-number">1</div>
            <h3>Discovery</h3>
            <p>We analyze your requirements, understand your business goals, and plan the perfect solution for your needs.</p>
        </div>

        <div class="process-step">
            <div class="step-number">2</div>
            <h3>Design</h3>
            <p>Our creative team designs beautiful, user-friendly interfaces that align with your brand identity.</p>
        </div>

        <div class="process-step">
            <div class="step-number">3</div>
            <h3>Development</h3>
            <p>We build robust, scalable solutions using cutting-edge technologies and best coding practices.</p>
        </div>

        <div class="process-step">
            <div class="step-number">4</div>
            <h3>Launch</h3>
            <p>We deploy your solution, provide training, and ensure everything runs smoothly from day one.</p>
        </div>
    </div>
</section>

<!-- Portfolio Preview -->
<section class="portfolio-preview">
    <div class="section-header">
        <h2>Featured <span>Projects</span></h2>
        <p>Take a look at some of our recent work and successful client partnerships</p>
    </div>
    <div class="portfolio-grid">
        <div class="portfolio-card">
            <div class="portfolio-image">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop" alt="E-commerce Platform">
                <div class="portfolio-overlay">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
            <div class="portfolio-info">
                <div class="portfolio-category">E-COMMERCE</div>
                <h3>Modern Shopping Platform</h3>
                <p>A full-featured e-commerce solution with payment integration, inventory management, and analytics.</p>
            </div>
        </div>

        <div class="portfolio-card">
            <div class="portfolio-image">
                <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=600&h=400&fit=crop" alt="AI Dashboard">
                <div class="portfolio-overlay">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
            <div class="portfolio-info">
                <div class="portfolio-category">AI SOLUTION</div>
                <h3>AI Analytics Dashboard</h3>
                <p>Intelligent data visualization platform with predictive analytics and machine learning capabilities.</p>
            </div>
        </div>

        <div class="portfolio-card">
            <div class="portfolio-image">
                <img src="https://images.unsplash.com/photo-1559028012-481c04fa702d?w=600&h=400&fit=crop" alt="Mobile App">
                <div class="portfolio-overlay">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
            <div class="portfolio-info">
                <div class="portfolio-category">WEB APP</div>
                <h3>Project Management System</h3>
                <p>Collaborative platform for teams to manage projects, track progress, and communicate efficiently.</p>
            </div>
        </div>
    </div>
    <div class="view-all-btn">
        <a href="projects.php" class="btn btn-primary">
            View All Projects
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials">
    <div class="section-header">
        <h2>Client <span>Testimonials</span></h2>
        <p>Don't just take our word for it - hear what our clients have to say</p>
    </div>
    <div class="testimonials-grid">
        <div class="testimonial-card">
            <div class="quote-icon">
                <i class="fas fa-quote-left"></i>
            </div>
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p class="testimonial-text">
                "Horizon Tech transformed our online presence completely. Their team delivered a stunning website that increased our conversions by 150%. Highly professional!"
            </p>
            <div class="testimonial-author">
                <div class="author-image">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=120&h=120&fit=crop" alt="John Smith">
                </div>
                <div class="author-info">
                    <h4>John Smith</h4>
                    <p>CEO, TechStart Inc.</p>
                </div>
            </div>
        </div>

        <div class="testimonial-card">
            <div class="quote-icon">
                <i class="fas fa-quote-left"></i>
            </div>
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p class="testimonial-text">
                "The AI solution they built for us has streamlined our operations significantly. Their expertise in machine learning is truly impressive. Best investment we've made!"
            </p>
            <div class="testimonial-author">
                <div class="author-image">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=120&h=120&fit=crop" alt="Sarah Johnson">
                </div>
                <div class="author-info">
                    <h4>Sarah Johnson</h4>
                    <p>Operations Director, LogiCorp</p>
                </div>
            </div>
        </div>

        <div class="testimonial-card">
            <div class="quote-icon">
                <i class="fas fa-quote-left"></i>
            </div>
            <div class="rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p class="testimonial-text">
                "Outstanding work on our e-commerce platform! The team was responsive, creative, and delivered beyond expectations. Our sales have tripled since launch."
            </p>
            <div class="testimonial-author">
                <div class="author-image">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=120&h=120&fit=crop" alt="Michael Chen">
                </div>
                <div class="author-info">
                    <h4>Michael Chen</h4>
                    <p>Founder, StyleHub</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="stats-grid">
        <div class="stat-item">
            <span class="stat-number" data-target="150">0</span>
            <span class="stat-label">Projects Completed</span>
        </div>
        <div class="stat-item">
            <span class="stat-number" data-target="120">0</span>
            <span class="stat-label">Happy Clients</span>
        </div>
        <div class="stat-item">
            <span class="stat-number" data-target="98">0</span>
            <span class="stat-label">Success Rate %</span>
        </div>
        <div class="stat-item">
            <span class="stat-number" data-target="15">0</span>
            <span class="stat-label">Team Members</span>
        </div>
    </div>
</section>

<!-- Technologies -->
<section class="technologies">
    <div class="section-header">
        <h2>Technologies We <span>Master</span></h2>
        <p>We work with cutting-edge technologies to build robust and scalable solutions</p>
    </div>
    <div class="tech-grid">
        <div class="tech-item">
            <i class="fab fa-php"></i>
            <h4>PHP</h4>
        </div>
        <div class="tech-item">
            <i class="fab fa-js"></i>
            <h4>JavaScript</h4>
        </div>
        <div class="tech-item">
            <i class="fab fa-react"></i>
            <h4>React</h4>
        </div>
        <div class="tech-item">
            <i class="fab fa-python"></i>
            <h4>Python</h4>
        </div>
        <div class="tech-item">
            <i class="fab fa-node-js"></i>
            <h4>Node.js</h4>
        </div>
        <div class="tech-item">
            <i class="fas fa-database"></i>
            <h4>MySQL</h4>
        </div>
        <div class="tech-item">
            <i class="fab fa-wordpress"></i>
            <h4>WordPress</h4>
        </div>
        <div class="tech-item">
            <i class="fab fa-figma"></i>
            <h4>Figma</h4>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-content">
        <h2>Ready to Start Your Project?</h2>
        <p>Let's collaborate to bring your vision to life. Our team of experts is ready to transform your ideas into exceptional digital solutions that drive real business results.</p>
        <a href="contact.php" class="btn btn-primary">
            Contact Us Today
            <i class="fas fa-paper-plane"></i>
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
    document.querySelectorAll('.section-header, .service-card, .stat-item, .cta-content, .process-step, .portfolio-card, .testimonial-card, .why-image, .why-text, .tech-item').forEach(el => {
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

    // Stagger animation for service cards
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach((card, index) => {
        setTimeout(() => {
            observer.observe(card);
        }, index * 100);
    });

    // Stagger animation for tech items
    const techItems = document.querySelectorAll('.tech-item');
    techItems.forEach((item, index) => {
        setTimeout(() => {
            observer.observe(item);
        }, index * 50);
    });
</script>

<?php include 'includes/footer.php'; ?>