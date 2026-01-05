# Africa Climate and Environment Foundation (ACEF) Website

## Overview
The Africa Climate and Environment Foundation (ACEF) website is a premium, youth-led digital platform dedicated to climate action, environmental protection, and sustainable development across Africa. Registered in 2021, ACEF serves as a collaborative hub for empowering grassroots communities, particularly youth and women, to address the triple planetary crisis: climate change, biodiversity loss, and pollution.

## Core Identity
- **Vision**: A resilient Africa where empowered youth lead innovative solutions for climate action and environmental protection.
- **Mission**: To bridge the hunger and poverty gap through climate mitigation, environmental conservation, and sustainable natural resource management.
- **Tagline**: Empowering Grassroots for a Sustainable Future.

## Technical Stack
- **Framework**: Laravel 11
- **Frontend**: Blade Templating Engine
- **Styling**: Tailwind CSS
- **Build Tool**: Vite
- **Language**: PHP 8.2+

## Architecture and Pages
The application is structured into several key functional areas:
- **Home**: Featuring strategic imperatives and a message from the founder.
- **About Us**: Detailed organizational profile, mission, vision, and strategic objectives.
- **Programmes**: Showcase of the 10 Programme Pillars (2025-2030).
- **Projects & Impact**: Interactive record of projects across 14 African nations and real-time impact metrics.
- **Knowledge Hub**: Accessible research papers, strategic plans, and policy briefs.
- **Insights (Blog)**: Educational content on conservation, renewable energy, and community resilience.
- **Governance**: Sections for Leadership, Partners, and UN Accreditations.
- **Form Submissions**: Professional backend-driven contact and involvement forms (Volunteer, Partner, Collaborate) with email notifications.


## Strategic Framework
The website integrates content from official documentation, including:
- Strategic Plan (2025-2026)
- 5-Year Programme of Work (2025-2030)
- Policy Advocacy and International Engagement Framework (UNFCCC, UNEP, ECOSOC, IPBES)

## Local Development
To set up the project locally:

1. Clone the repository.
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install Node dependencies:
   ```bash
   npm install
   ```
4. Configure the environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Compile assets:
   ```bash
   npm run dev
   ```
6. Start the development server:
   ```bash
    php -c php.ini -S 127.0.0.1:9090 -t public
   ```


## Access & Testing

The platform includes role-based dashboards for different user types. Use the following credentials to access the system:

### 1. Admin Portal
- **Login URL**: [http://127.0.0.1:9090/login](http://127.0.0.1:9090/login)

- **Features**: Full system access, User Management, Content Management (Articles, Projects), Payment Settings, Donation Tracking.

### 2. Country Coordinator Portal
- **Login URL**: [http://127.0.0.1:9090/login](http://127.0.0.1:9090/login) (Auto-redirects to Coordinator Dashboard)
- **Registration URL**: [http://127.0.0.1:9090/register](http://127.0.0.1:9090/register) (Select "Country Coordinator" role)

- **Features**: Country-specific project view, Article creation (Drafts), Media Library access.

## Production Deployment

### Environment Setup
For production, use `.env.example.production` as a template for your `.env` file. It contains pre-configured mail settings and production-ready defaults.

### cPanel Shared Hosting Deployment
Deployment to cPanel typically involves:
1. Setting up SSH access in cPanel.
2. Generating and adding an SSH key to your Git provider (GitHub/GitLab).
3. Cloning the repository into a folder *above* `public_html`.
4. Configuring a symbolic link or updating the web root to point to the `public` directory.

[Detailed Deployment Guide](DEPLOYMENT.md)

## Contribution and Legal

This project is maintained by the ACEF Technical Team. For information regarding data protection and terms of use, refer to the Privacy Policy and Terms of Service pages within the application.
