CREATE TABLE admission_applications (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,

    apply_class ENUM(
        'Nursery',
        'LKG',
        'UKG',
        '1','2','3','4','5','6',
        '7','8','9','10','11','12'
    ) NOT NULL,

    student_name VARCHAR(150) NOT NULL,
    father_name VARCHAR(150) NOT NULL,
    mother_name VARCHAR(150) NOT NULL,

    gender ENUM('Male','Female','Other') NOT NULL,

    dob DATE NOT NULL,

    blood_group ENUM(
        'A+','A-',
        'B+','B-',
        'AB+','AB-',
        'O+','O-'
    ),

    identification_mark VARCHAR(255),

    religion VARCHAR(50),

    category ENUM(
        'General',
        'OBC',
        'EBC',
        'SC',
        'ST',
        'EWS',
        'Other'
    ),

    mother_tongue VARCHAR(50),

    student_aadhaar CHAR(12) UNIQUE,

    last_school VARCHAR(255),

    address TEXT,
    city VARCHAR(100),
    pin CHAR(6),
    state VARCHAR(100),

    phone VARCHAR(15),
    email VARCHAR(150),

    student_photo VARCHAR(255),

    doc_student_aadhaar VARCHAR(255),
    doc_father_aadhaar VARCHAR(255),
    doc_mother_aadhaar VARCHAR(255),

    status ENUM(
        'received',
        'verified',
        'completed',
        'deleted'
    ) DEFAULT 'received',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    verified_at TIMESTAMP NULL
);


CREATE TABLE notices (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,

    title VARCHAR(255) NOT NULL,

    content TEXT NOT NULL,

    category ENUM(
        'admission',
        'examination',
        'holiday',
        'event',
        'circular',
        'announcement',
        'academic',
        'fee',
        'result',
        'scholarship',
        'sports',
        'emergency',
        'recruitment',
        'tender',
        'other'
    ) NOT NULL DEFAULT 'announcement',

    links JSON NULL,

    documents JSON NULL,

    status ENUM(
        'draft',
        'published',
        'archived'
    ) DEFAULT 'draft',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE enquiries (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,

    name VARCHAR(150) NOT NULL,

    email VARCHAR(150),

    phone VARCHAR(15) NOT NULL,

    message TEXT NOT NULL,

    status ENUM(
        'pending',
        'replied'
    ) DEFAULT 'pending',

    reply TEXT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    replied_at TIMESTAMP NULL
);

CREATE TABLE albums (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,

    title VARCHAR(255) NOT NULL,

    description TEXT,

    cover VARCHAR(255) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE album_medias (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,

    album_id BIGINT NOT NULL,

    photo VARCHAR(255) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_album_media_album
        FOREIGN KEY (album_id)
        REFERENCES albums(id)
        ON DELETE CASCADE
);

CREATE TABLE users (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,

    username VARCHAR(100) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    role ENUM(
        'student',
        'school'
    ) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE vacancies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_title VARCHAR(255) NOT NULL,
    role_description TEXT NOT NULL,
    department ENUM(
        'academic-faculty',
        'administration',
        'support-staff',
        'other'
    ) NOT NULL,
    type ENUM(
        'full-time',
        'part-time',
        'contract',
        'internship',
        'temporary',
        'freelance'
    ) NOT NULL,
    openings INT NOT NULL DEFAULT 1,
    deadline DATE NOT NULL,
    status ENUM(
        'open',
        'paused',
        'closed',
        'deleted'
    ) NOT NULL DEFAULT 'open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE vacancy_apply (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    vacancy_id INT NOT NULL,
    resume VARCHAR(255) NOT NULL,
    additional_info TEXT,
    applied_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_vacancy_apply_vacancy
        FOREIGN KEY (vacancy_id)
        REFERENCES vacancies(id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);