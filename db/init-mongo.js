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
            _id: 'admin@ancl.it',
            role: 'admin',
            displayName: 'Posso Modificare',
            // 12345678
            password: '$2y$10$JLwOGSlcmIqjP/bw4cn5zehJfL5BkfjMVTVzFOOjc/Db13lDtEU0.'
        },
        {
            _id: 'utente@ancl.it',
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
            sector_id: ObjectId("606dc436851fe45cd6a96554"),
            valid_from: ISODate("2021-01-01"),
            stipule: [
                {
                    name: "Accordo di rinnovo",
                    dataStipula: "30 marzo 2015",
                    decorrenza: "1 aprile 2015",
                    scadenza: "31 luglio 2018",
                    parti: "Confcommercio e Filcams-Cgil, Fisascat-Cisl, Uiltucs-Uil"
                },
                {
                    name: "Accordo di rinnovo",
                    dataStipula: "6 aprile 2011",
                    decorrenza: "1 gennaio 2011",
                    scadenza: "31 dicembre 2013",
                    parti: "Confcommercio e Fisascat-Cisl, Uiltucs-Uil"
                },
                {
                    name: "CCNL",
                    dataStipula: "18 luglio 2008",
                    decorrenza: "1 gennaio 2007",
                    scadenza: "31 dicembre 2010",
                    parti: "Confcommercio e Filcams-Cgil, Fisascat-Cisl, Uiltucs-Uil"
                }
            ],
            parametri: {
                divisori: "Quota giornaliera 26; quota oraria 168 (personale a 40 ore settimanali), 182 (personale a 42 ore settimanali), 195 (personale a 45 ore settimanali).",
                mensilita: 14
            },
            welfare: {
                previdenza: `Contribuzione al fondo Fon.Te. (previdenza complementare per i lavoratori del settore): \n- a carico azienda, 1,55% della retribuzione utile per il calcolo del tfr;\n- a carico lavoratore, 0,55% della stessa base di computo, oltre al versamento dell’intero tfr maturato annualmente per coloro che hanno iniziato l’attività lavorativa dopo il 28.4.1993 (50% del tfr maturato se l’attività è iniziata in precedenza).\n Per i lavoratori assunti con contratto a tempo determinato di sostegno all’occupazione la contribuzione a carico azienda è pari all’1,05%; tale contribuzione ridotta viene applicata anche in caso di trasformazione a tempo indeterminato per i primi 24 mesi.`,
                assistenza: `Contribuzione al fondo Est di assistenza sanitaria:\n- a carico azienda: 10 euro/mese per ciascun lavoratore, sia a tempo pieno che a tempo parziale (dal 1° gennaio 2014);\n- a carico lavoratore: 2 euro/mese (dal 1° gennaio 2012).\nSono iscritti al Fondo i lavoratori assunti con contratto a tempo indeterminato, sia a tempo pieno che a tempo parziale, compresi gli apprendisti ed esclusi i quadri. L’azienda che ometta il versamento dei contributi è tenuta ad erogare un e.d.r. sostitutivo (vedi sopra Dati retributivi - Altre voci).\nContribuzione alla cassa Qu.A.S. di assistenza sanitaria per i quadri:\n- a carico azienda: 350 euro/anno;\n- a carico lavoratore: 56 euro/anno. \nL’azienda che ometta il versamento dei contributi è tenuta ad erogare un e.d.r. sostitutivo (vedi sopra Dati retributivi -Altre voci).`,
                enti: `Per il finanziamento degli enti bilaterali territoriali è stabilito un contributo in misura pari allo 0,15% della paga base e dell’indennità di contingenza, di cui 0,05% a carico del lavoratore e 0,10% a carico del datore di lavoro.\nL’azienda che ometta il versamento dei contributi è tenuta ad erogare un e.d.r. sostitutivo (vedi sopra Dati retributivi - Altre voci). Contributo al Quadrifor (Istituto per lo sviluppo della formazione dei quadri del terziario):\n- a carico azienda: 50 euro/anno\n- a carico lavoratore: 25 euro/anno.`,
                polizze: `Quadri. Hanno diritto ad una copertura in forma assicurativa per le spese e l’assistenza legale in caso di procedimenti civili/penali per cause non dipendenti da colpa grave o dolo e relative a fatti direttamente connessi con l’esercizio delle funzioni svolte.\nOperatori di vendita. A seguito di infortunio sul lavoro le aziende devono garantire la corresponsione, aggiuntiva al trattamento Inail, dei seguenti importi:\n- euro 27.500 in caso di morte;\n- euro 37.500 in caso di invalidità permanente totale.`
            }
        }
    ]
)
