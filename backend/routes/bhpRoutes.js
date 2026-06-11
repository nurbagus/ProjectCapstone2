const express = require('express');
const router = express.Router();

const bhpController =
require('../controllers/bhpController');

const verifyToken =
require('../middleware/authMiddleware');

const checkRole =
require('../middleware/roleMiddleware');

router.post(
    '/bhp',
    verifyToken,
    checkRole('staf_admin'),
    bhpController.createBhp
);

router.get(
    '/bhp',
    verifyToken,
    bhpController.getBhp
);

router.put(
    '/bhp/:id/in',
    verifyToken,
    checkRole('staf_admin'),
    bhpController.stockIn
);

router.put(
    '/bhp/:id/out',
    verifyToken,
    checkRole('staf_admin','staf_lab'),
    bhpController.stockOut
);

router.get(
    '/bhp/logs',
    verifyToken,
    bhpController.getLogs
);

router.get(
    '/bhp/low-stock',
    verifyToken,
    bhpController.lowStock
);

module.exports = router;