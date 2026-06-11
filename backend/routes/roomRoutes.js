const express = require('express');
const router = express.Router();

const roomController =
require('../controllers/roomController');

const verifyToken =
require('../middleware/authMiddleware');

const checkRole =
require('../middleware/roleMiddleware');

router.get(
    '/rooms',
    verifyToken,
    checkRole('administrator','staf_admin'),
    roomController.getRooms
);

router.post(
    '/rooms',
    verifyToken,
    checkRole('administrator'),
    roomController.createRoom
);

router.put(
    '/rooms/:id',
    verifyToken,
    checkRole('administrator'),
    roomController.updateRoom
);

router.delete(
    '/rooms/:id',
    verifyToken,
    checkRole('administrator'),
    roomController.deleteRoom
);

module.exports = router;