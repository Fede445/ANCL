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
            "_id": ObjectId("606dc436851fe45cd6a96553"),
            name: "Agenzie Immobiliari"
        },
        {
            "_id": ObjectId("606dc436851fe45cd6a96554"),
            name: "Agricoltura (Impiegati)"
        },
        {
            "_id": ObjectId("606dc436851fe45cd6a96555"),
            name: "Agricoltura (Operai)"
        },
        {
            "_id": ObjectId("606dc436851fe45cd6a96556"),
            name: "Terziario - Confcommercio"
        },
        {
            "_id": ObjectId("606dc436851fe45cd6a96557"),
            name: "Metalmeccanica - Industria"
        }
    ]
);

db.sectors.createIndex({ name: "text" }, { default_language: "italian" })

db.createCollection("tables")

db.tables.insertMany(
    [
        {
            name: "tabella 1",
            valid_from: 1,
            sector_id: ObjectId("606dc436851fe45cd6a96554")
        },
        {
            name: "tabella 2",
            valid_from: 2,
            sector_id: ObjectId("606dc436851fe45cd6a96555")
        }
    ]
)
