const express = require('express');
const router = express.Router();

const userController =
require('../controllers/userController');

const verifyToken =
require('../middleware/authMiddleware');

const checkRole =
require('../middleware/roleMiddleware');

router.get(
    '/users',
    verifyToken,
    checkRole('administrator'),
    userController.getUsers
);

router.post(
    '/users',
    verifyToken,
    checkRole('administrator'),
    userController.createUser
);

router.put(
    '/users/:id',
    verifyToken,
    checkRole('administrator'),
    userController.updateUser
);

router.delete(
    '/users/:id',
    verifyToken,
    checkRole('administrator'),
    userController.deleteUser
);

module.exports = router;