<?php
try {
    $db = new PDO('sqlite:database/database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully\n";

    $db->exec("BEGIN TRANSACTION");

    // Programs
    // current cols: id, title, slug, excerpt, content, image, hero_image, impact_stories, focus_areas, status, created_at, updated_at, funding_goal, funding_raised, duration, location, factsheet, category, icon, meta_val, country, stats, status_temp
    echo "Updating programs table status...\n";
    $db->exec("CREATE TABLE programs_new (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title VARCHAR NOT NULL,
        slug VARCHAR NOT NULL UNIQUE,
        excerpt TEXT,
        content TEXT NOT NULL,
        image VARCHAR,
        hero_image VARCHAR,
        impact_stories JSON,
        focus_areas JSON,
        status VARCHAR DEFAULT 'draft',
        created_at DATETIME,
        updated_at DATETIME,
        funding_goal DECIMAL(12,2),
        funding_raised DECIMAL(12,2),
        duration VARCHAR,
        location VARCHAR,
        factsheet VARCHAR,
        category VARCHAR,
        icon VARCHAR,
        meta_val TEXT,
        country JSON,
        stats JSON
    )");
    $db->exec("INSERT INTO programs_new (id, title, slug, excerpt, content, image, hero_image, impact_stories, focus_areas, status, created_at, updated_at, funding_goal, funding_raised, duration, location, factsheet, category, icon, meta_val, country, stats) 
              SELECT id, title, slug, excerpt, content, image, hero_image, impact_stories, focus_areas, status, created_at, updated_at, funding_goal, funding_raised, duration, location, factsheet, category, icon, meta_val, country, stats FROM programs");
    $db->exec("DROP TABLE programs");
    $db->exec("ALTER TABLE programs_new RENAME TO programs");

    // Projects
    // current cols: id, title, slug, description, category, country, status, goal_amount, raised_amount, image, start_date, end_date, is_featured, is_active, created_at, updated_at, location, gallery, objectives, video_url, voices, programme_id
    echo "Updating projects table status...\n";
    $db->exec("CREATE TABLE projects_new (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title VARCHAR NOT NULL,
        slug VARCHAR NOT NULL UNIQUE,
        description TEXT NOT NULL,
        category VARCHAR NOT NULL,
        country TEXT,
        status VARCHAR DEFAULT 'draft',
        goal_amount DECIMAL(12,2),
        raised_amount DECIMAL(12,2) DEFAULT 0,
        image VARCHAR,
        start_date DATE,
        end_date DATE,
        is_featured BOOLEAN DEFAULT 0,
        is_active BOOLEAN DEFAULT 1,
        created_at DATETIME,
        updated_at DATETIME,
        location VARCHAR,
        gallery TEXT,
        objectives TEXT,
        video_url VARCHAR,
        voices TEXT,
        programme_id INTEGER
    )");
    $db->exec("INSERT INTO projects_new (id, title, slug, description, category, country, status, goal_amount, raised_amount, image, start_date, end_date, is_featured, is_active, created_at, updated_at, location, gallery, objectives, video_url, voices, programme_id) 
              SELECT id, title, slug, description, category, country, status, goal_amount, raised_amount, image, start_date, end_date, is_featured, is_active, created_at, updated_at, location, gallery, objectives, video_url, voices, programme_id FROM projects");
    $db->exec("DROP TABLE projects");
    $db->exec("ALTER TABLE projects_new RENAME TO projects");

    $db->commit();
    echo "Database updated successfully.\n";

} catch (Exception $e) {
    if (isset($db)) $db->rollBack();
    echo "Error: " . $e->getMessage() . "\n";
}
