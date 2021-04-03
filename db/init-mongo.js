db.createUser(
    {
        user: "apache_web_server",
        pwd: "RQmUP6fZFHdDbrKh",
        roles: [
            {
                role: "readWrite",
                db: "ancl"
            }
        ]
    }
);

db.createCollection('users');

db.users.insertMany(
    [
        {
            _id: 'capoSupremo',
            role: 'admin',
            displayName: 'Posso Modificare',
            // 12345678
            password: '$2y$10$JLwOGSlcmIqjP/bw4cn5zehJfL5BkfjMVTVzFOOjc/Db13lDtEU0.'
        },
        {
            _id: 'utente',
            role: 'viewer',
            displayName: 'Posso Leggere',
            // password
            password: '$2y$10$dzirTHWeeIiAwGqHtv4Rvuo0Wb4xVZAbpIJIAccwpJifPDZE53.i2'
        }
    ]
);

db.createCollection('sectors');

db.sectors.insertMany(
    [
        {
            name: "Agenzie Immobiliari"
        },
        {
            name: "Agricoltura (Impiegati)"
        },
        {
            name: "Agricoltura (Operai)"
        },
        {
            name: "Terziario - Confcommercio"
        },
        {
            name: "Metalmeccanica - Industria"
        }
    ]
);

db.sectors.createIndex({ name: "text" }, { default_language: "italian" })
