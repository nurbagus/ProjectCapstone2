const express = require('express');
const router = express.Router();

const inventoryController =
require('../controllers/inventoryController');

const verifyToken =
require('../middleware/authMiddleware');

const checkRole =
require('../middleware/roleMiddleware');

const upload =
require('../middleware/uploadInventory');

router.post(
    '/inventories',
    verifyToken,
    checkRole('staf_admin'),
    inventoryController.createInventory
);

router.get(
    '/inventories',
    verifyToken,
    inventoryController.getInventories
);

router.get(
    '/inventories/:id',
    verifyToken,
    inventoryController.getInventoryDetail
);

router.put(
    '/inventories/:id/condition',
    verifyToken,
    checkRole('staf_admin','staf_lab'),
    inventoryController.updateCondition
);

router.post(
    '/inventories/:id/upload',
    verifyToken,
    checkRole('staf_admin'),
    upload.single('foto'),
    inventoryController.uploadPhoto
);

module.exports = router;