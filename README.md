# Ru'a | رؤى
### A School Evaluation Platform for Palestine

**رؤى** منصة ويب تعليمية تهدف إلى تطوير آلية تقييم المدارس في فلسطين، من خلال توفير بيئة رقمية موحدة تتيح لأولياء الأمور والمشرفين التربويين تقييم المدارس وفق معايير واضحة، وتعزز الشفافية والتواصل بين الأسرة والمؤسسة التعليمية.

---

## About the Project

Ru'a addresses the lack of a unified digital platform for evaluating schools in Palestine, where parents often rely on personal impressions and verbal recommendations when choosing schools for their children.

The platform provides a structured evaluation system that brings together parents, school managers, educational supervisors, and administrators to support informed decision-making and continuous school improvement.

### Project Objectives

- Establish a unified digital system for collecting and managing school evaluation data.
- Provide standardized evaluation criteria covering educational quality and the school environment.
- Enable parents to evaluate schools and submit complaints.
- Empower educational supervisors to conduct official school evaluations and generate field reports.
- Improve communication between parents, schools, and supervisors.
- Provide analytical reports to support school performance improvement.
- Maintain data reliability, security, and user privacy.

---

## Key Features

### Parent Portal
- Search for schools by name, location, type, and educational level.
- Evaluate schools based on multiple criteria.
- Submit and track complaints.
- Add comments and feedback.
- Compare schools using different evaluation criteria.

### School Manager Portal
- Manage and update school information.
- Respond to parent complaints and evaluations.
- Monitor school performance through reports and analytics.
- Receive field reports from supervisors.
- Manage school media galleries, including images and videos.

### Supervisor Portal
- View assigned schools.
- Review complaints submitted by parents.
- Conduct official school evaluations following field visits.
- Create and submit field reports.
- Send reports to school management.
- Generate invitation links for school managers.

### Administrator Portal
- Manage platform users and accounts.
- Assign and manage user permissions.
- Manage schools, evaluations, and reports.
- Monitor platform activities.
- Provide administrative support.
- Generate invitation links for supervisors.

---

## User Roles & Permissions

| Role | Description |
|---|---|
| Parent | Searches for schools, submits evaluations, comments, and complaints. |
| School Manager | Manages school information, responds to feedback, and monitors reports. |
| Supervisor | Conducts official evaluations and prepares field reports. |
| Administrator | Manages users, permissions, platform content, and system activities. |

### Registration & Account Approval

- **Parents:** Public registration with email verification.
- **Supervisors:** Registration through administrator invitation, followed by approval and email verification.
- **School Managers:** Registration through supervisor invitation, followed by approval and email verification.
- **Administrators:** Accounts are created internally.

---

## Technology Stack

### Frontend
- React.js
- JavaScript (ES6+)
- HTML5
- Tailwind CSS
- Material UI (MUI)
- React Router DOM
- Axios
- TanStack React Query
- Vite
- Firebase

### Backend
- PHP 8.1+
- Laravel 10
- MySQL 8.0
- Eloquent ORM
- Laravel Sanctum
- Bcrypt

### External Services
- Google Maps API
- Google OAuth 2.0
- SMTP Email Services

### Development Tools
- Git & GitHub
- Composer
- Visual Studio Code
- Figma
- Postman
- Laragon

---

## System Architecture

Ru'a follows a **Three-Tier Architecture**, separating the presentation, application, and data layers.

| Layer | Technology | Responsibility |
|---|---|---|
| Presentation Layer | React.js & Tailwind CSS | User interface and interactions. |
| Application Layer | Laravel & PHP | Business logic and API processing. |
| Data Layer | MySQL | Data storage and management. |

The backend follows the **MVC (Model-View-Controller)** architectural pattern, with Laravel API endpoints providing JSON responses consumed by the frontend.

---

## Database Structure

The database contains more than 15 related tables, organized around the platform's core entities and relationships.

### Main Database Tables

| Table | Description |
|---|---|
| Users | User accounts and roles. |
| Schools | School information and details. |
| Evaluations | School evaluation records. |
| Criteria | Evaluation criteria. |
| Evaluation_Criteria | Scores assigned to individual criteria. |
| Parent_Children | Relationships between parents and children. |
| School_Supervisors | Relationships between schools and supervisors. |
| Achievements | School achievements. |
| Activities | School activities. |
| Complaints | Parent complaints. |
| Conversations | Communication records. |
| Reports | Evaluation and field reports. |
| Settings | Platform settings. |

The database uses relational modeling and normalization principles, including one-to-one, one-to-many, and many-to-many relationships.

---

## Security

The platform incorporates several security measures:

- Authentication and token-based access control.
- Password hashing using Bcrypt.
- Role-Based Access Control (RBAC).
- Protection against SQL Injection and XSS.
- Email verification.
- Temporary invitation links.
- Login attempt restrictions.
- Secure HTTPS communication in production environments.

---

## API Structure

The backend provides RESTful API endpoints organized according to user roles and platform functionality.

| Endpoint | Description |
|---|---|
| `/api/schools` | Public school listings, search, evaluations, and statistics. |
| `/api/parent/*` | Parent dashboard, profile, children, evaluations, and complaints. |
| `/api/supervisor/*` | School supervision, reports, invitations, and analytics. |
| `/api/manager/*` | School content management, complaints, and reports. |
| `/api/admin/*` | User, school, and report administration. |

---

## Testing & Quality Assurance

The project documentation covers several testing levels:

- Unit Testing
- Integration Testing
- User Interface Testing
- Performance Testing
- Security Testing
- User Acceptance Testing (UAT)

The documented testing results indicate that the functional and non-functional tests were successful and that identified defects were addressed.

---

## Future Improvements

1. Advanced analytics and AI-powered reporting.
2. Dedicated Android and iOS applications.
3. Additional user roles, including teachers and inspectors.
4. Enhanced security features, such as two-factor authentication.
5. Integration with external educational systems.
6. Multilingual platform support.
7. Full cloud deployment and infrastructure scalability.

---

## Development Team

| Name | Role |
|---|---|
| Shahd Ayman Khader | Development Team |
| Heba Ibrahem Abed | Development Team |
| Ruaa Mahmoud Mushtaha | Development Team |
| Haya Sameer Barhoum | Development Team |
| Eman Maher Al Reqeb | Development Team |

**Project Supervisor:** Dr. Tamer Nazer Madi

**Academic Project:** Bachelor's Degree in Information Technology

**Project Date:** November 2025

---

## Project Scope

- **Geographical Scope:** West Bank and Gaza Strip, Palestine.
- **Target Users:** Parents, school managers, educational supervisors, and administrators.
- **Educational Scope:** School education.
- **Platform:** Web-based application.
- **Primary Language:** Arabic.

---

## License

This project was developed as part of the graduation requirements for a Bachelor's Degree in Information Technology.

---

*Ru'a – Building a more transparent and informed educational evaluation experience in Palestine.*
