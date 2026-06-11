const multer = require('multer');
const path = require('path');

const storage = multer.diskStorage({

    destination: (req, file, cb) => {

        cb(
            null,
            'uploads/inventory'
        );

    },

    filename: (req, file, cb) => {

        const fileName =
            Date.now() +
            path.extname(file.originalname);

        cb(null, fileName);

    }

});

module.exports =
multer({ storage });