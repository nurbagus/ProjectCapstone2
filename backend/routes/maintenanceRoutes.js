const express = require('express');
const router = express.Router();

const maintenanceController =
require('../controllers/maintenanceController');

const verifyToken =
require('../middleware/authMiddleware');

const checkRole =
require('../middleware/roleMiddleware');

router.post(
    '/maintenance',
    verifyToken,
    checkRole('staf_lab'),
    maintenanceController.createMaintenance
);

router.get(
    '/maintenance',
    verifyToken,
    maintenanceController.getMaintenances
);

router.get(
    '/maintenance/:id',
    verifyToken,
    maintenanceController.getMaintenanceDetail
);

module.exports = router;

