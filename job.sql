DROP TABLE IF EXISTS eoi;

CREATE TABLE eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    Job_Reference_Number VARCHAR(5) NOT NULL,
    First_name VARCHAR(20) NOT NULL,
    Last_name VARCHAR(20) NOT NULL,
    DOB DATE NOT NULL,
    Gender VARCHAR(10) NOT NULL,
    Street_address VARCHAR(40) NOT NULL,
    Suburb VARCHAR(40) NOT NULL,
    State VARCHAR(3) NOT NULL,
    Postcode VARCHAR(4) NOT NULL,
    Email_address VARCHAR(50) NOT NULL,
    Phone_number VARCHAR(12) NOT NULL,
    Skills_list TEXT,           
    Other_skills TEXT,      
    Status VARCHAR(10) DEFAULT 'New' 
);


DROP TABLE IF EXISTS jobs;

CREATE TABLE jobs (
    job_id INT AUTO_INCREMENT PRIMARY KEY,
    reference VARCHAR(5) NOT NULL UNIQUE,
    title VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    salary_range VARCHAR(50),
    reporting_to VARCHAR(50),
    responsibilities TEXT,      
    essential_skills TEXT,
    preferable_skills TEXT
);

INSERT INTO jobs (reference, title, description, salary_range, reporting_to, responsibilities, essential_skills, preferable_skills) VALUES
('NA12B', 'Network Administrator', 'The Network Administrator manages corporate LAN/WAN, ensures uptime, configures enterprise switches/routers, performs monitoring, and implements security controls.', 'AU$85,000 - AU$105,000 per annum', 'Senior Network Engineer', '1. Deploy and maintain network switches, routers, firewalls and wireless systems. 2. Monitor network health and respond to incidents to achieve SLA targets. 3. Carry out network configuration changes, backups and documentation. 4. Collaborate with security team to apply patches and firewall rules.', 'Bachelor''s degree in IT or equivalent experience, 3+ years in network administration, Knowledge of TCP/IP/VLANs/OSPF/BGP/DHCP/DNS, CCNA or equivalent certification.', 'Experience with automation (Ansible) and scripting (Python, Bash), Experience in cloud networking (AWS VPC / Azure VNets).'),

('ITSM7', 'IT Service Management Analyst', 'The ITSM Analyst focuses on ITIL-based incident, problem and change processes, drives service improvements and coordinates between stakeholders to ensure high-quality IT service delivery.', 'AU$70,000 - AU$90,000 per annum', 'IT Operations Manager', '1. Manage incident lifecycle and ensure first response SLAs are met. 2. Run problem investigations and document root causes. 3. Coordinate change approvals and release windows with stakeholders.', '2+ years in IT support or service management, Familiarity with ITIL foundations and ticketing systems (Jira Service Management preferred).', 'Experience with service automation and reporting (Power BI/Excel).');

DROP TABLE IF EXISTS managers;

CREATE TABLE managers (
    manager_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);


INSERT INTO managers (username, password_hash) VALUES 
('hr_manager', '$2y$10$OJuJk6wq3z.Sy6pok2lZrOyvGE3KCP/b6.j6XhQuLU1PoKZYSy5am');