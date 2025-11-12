<?php 
$pageTitle = "Career Opportunities";
include 'header.inc';
include 'nav.inc';
?>

<body>
    <main id="job-listing">
        <h1>Current Job Vacancies at AlgoWeave</h1>

        <!-- POSITION 1: G01 - Software Developer -->
        <section id="job-software-developer">
            <aside id="job-aside">
                <h2>Software Developer</h2>

                <p>Position Reference Number: <br><b>SDV01</b></p>
                <p>Salary Range: <br><b>$80,000</b> - <b>$110,000</b></p>
                <p>Reports To: <br><b>Engineering Manager</b></p>
                <a href="#softdev-responsibilities"><button class="job-button">Job in Details</button></a>
            </aside>
            <section class="description">
                <h2>Software Developer</h2>
                <h3>Position Summary</h3>
                <p>The Software Developer will be involved in the full software development lifecycle, from initial concept and design through deployment and operation. This role is focused on designing and implementing high-quality, robust, and scalable software solutions for our core service platform, which handles millions of daily transactions. We operate in a highly collaborative, fast-paced Agile Scrum environment. We are seeking individuals passionate about clean code, continuous improvement, and capable of working effectively across various functional teams to deliver exceptional user experiences and robust back-end services. This position offers exposure to cutting-edge technologies and direct impact on product success.</p>
            </section>

            <section id="softdev-responsibilities">
                <h3>Key Responsibilities</h3>
                <ol>
                    <li>Design, build, and maintain efficient, reusable, and reliable code using Python and Java, ensuring optimal performance and security of applications.</li>
                    <li>Perform thorough unit testing, integration testing, and system testing to ensure fault tolerance.</li>
                    <li>Actively participate in code reviews, providing constructive feedback to peers and integrating feedback into your own work.</li>
                    <li>Collaborate closely with the Product, UX/UI, and QA teams to translate ambiguous business requirements into clear, technical features and execution plans.</li>
                    <li>Troubleshoot, debug, and resolve complex production issues and improve application performance across various staging and production environments.</li>
                    <li>Contribute to the enhancement of CI/CD pipelines and automated deployment processes to streamline releases.</li>
                </ol>
            </section>

            <section class="requirements">
                <h3>Qualifications and Skills</h3>

                <h4>Essential Requirements</h4>
                <ul>
                    <li>Bachelor's Degree in Computer Science, Software Engineering, or a related technical field.</li>
                    <li>Minimum 3 years of hands-on experience in Back-end software development using either Python or Java.</li>
                    <li>Strong understanding of Microservices architecture, object-oriented programming (OOP), and designing/consuming RESTful APIs.</li>
                    <li>Expertise in working with relational and NoSQL databases (e.g., PostgreSQL, MongoDB).</li>
                    <li>Proficiency with Git/GitHub for version control and collaborative development.</li>
                </ul>

                <h4>Preferable Requirements</h4>
                <ul>
                    <li>Experience with front-end frameworks like Spring Boot (Java) or Django/Flask (Python).</li>
                    <li>Familiarity with CI/CD concepts and tools like Docker/Kubernetes.</li>
                    <li>Knowledge of W3C standards and Accessibility principles (WCAG 2.1).</li>
                    <li>Prior experience in FinTech or high-volume transactional systems.</li>
                </ul>
            </section>
        </section>


        <!-- POSITION 2: G06 - Cloud Engineer -->
        <section id="job-cloud-engineer">
            <aside id="job-aside">
                <h2>Cloud Engineer</h2>
                <p>Position Reference Number: <br><b>CLE06</b></p>
                <p>Salary Range:<br><b>$95,000</b> - <b>$130,000</b></p>
                <p>Reports To:<br><b>Infrastructure Director</b></p>
                <a href="#cloud-responsibilities"><button class="job-button">Job in Details</button></a>
            </aside>
            
            <section>
                <h2>Cloud Engineer</h2>
                <h3>Department and Environment</h3>
                <p>This position belongs to the specialized DevOps Team and will primarily utilize Google Cloud Platform (GCP). The team is responsible for infrastructure resilience and security. We strongly support professional growth, offering an annual learning budget and dedicated time for obtaining professional Cloud certifications like GCP Professional Cloud Engineer and Cloud Security Engineer.</p>
            </section>

            <section id="description">
                <h3>Position Summary</h3>
                <p>The Cloud Engineer is a critical role responsible for the continuous design, implementation, and management of our automated, secure, and scalable cloud infrastructure. This involves working with Infrastructure as Code (IaC) tools to provision and manage cloud resources across multiple regions, ensuring high availability (HA) and disaster recovery (DR) capabilities. This role is fundamental in maintaining the uptime, security posture, and cost efficiency of AlgoWeave's entire online service portfolio.</p>
            </section>

            <section id="cloud-responsibilities">
                <h3>Key Responsibilities</h3>
                <ol>
                    <li>Design, implement, and manage highly reliable and cost-effective cloud resources on Google Cloud Platform (GCP), including Compute Engine, Cloud SQL, and networking components.</li>
                    <li>Develop and maintain infrastructure using Terraform to achieve 100% automation of environment setup and configuration.</li>
                    <li>Develop automated CI/CD pipelines using Jenkins or Gitlab CI to facilitate rapid and safe deployment of applications.</li>
                    <li>Implement and enforce cloud security best practices, including IAM management, network segmentation, and security auditing.</li>
                    <li>Monitor system performance using advanced tooling and rapidly respond to security or performance incidents, participating in an on-call rotation.</li>
                    <li>Write infrastructure automation scripts and tools using Bash or Python to eliminate manual tasks and improve operational efficiency.</li>
                </ol>
            </section>

            <section class="requirements">
                <h3>Qualifications and Skills</h3>

                <h4>Essential Requirements</h4>
                <ul>
                    <li>Minimum 2 years of professional experience working with a major Cloud provider (AWS, Azure, or GCP—GCP preferred).</li>
                    <li>Strong skills in Infrastructure as Code (IaC) using Terraform.</li>
                    <li>Extensive hands-on experience with containerization technologies: Docker and Kubernetes.</li>
                    <li>Working knowledge of Linux system administration and networking concepts (TCP/IP, DNS, VPNs).</li>
                </ul>

                <h4>Preferable Requirements</h4>
                <ul>
                    <li>Professional Cloud certification (e.g., Google Cloud Professional Cloud Engineer or DevOps Engineer).</li>
                    <li>Experience with monitoring and logging tools (e.g., Prometheus, Grafana, ELK Stack).</li>
                    <li>Familiarity with configuration management tools like Ansible or Puppet.</li>
                </ul>
            </section>
        </section>

    </main>
    <?php include 'footer.inc'; ?>
</body>