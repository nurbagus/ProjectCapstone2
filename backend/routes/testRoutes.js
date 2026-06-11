const express = require('express');
const router = express.Router();

const verifyToken =
require('../middleware/authMiddleware');

const checkRole =
require('../middleware/roleMiddleware');

router.get(
    '/admin',
    verifyToken,
    checkRole('administrator'),
    (req, res) => {

        res.json({
            message: 'Selamat datang Admin'
        });

    }
);

router.get(
    '/kaprodi',
    verifyToken,
    checkRole('kaprodi'),
    (req, res) => {

        res.json({
            message: 'Selamat datang Kaprodi'
        });

    }
);

module.exports = router;