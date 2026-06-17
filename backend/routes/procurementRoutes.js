const express = require('express');
const router = express.Router();

const procurementController =
require('../controllers/procurementController');

const verifyToken =
require('../middleware/authMiddleware');

const checkRole =
require('../middleware/roleMiddleware');

router.post(
    '/drafts',
    verifyToken,
    checkRole('kepala_lab'),
    procurementController.createDraft
);

router.get(
    '/drafts',
    verifyToken,
    procurementController.getDrafts
);

router.get(
    '/drafts-review',
    verifyToken,
    checkRole('kaprodi'),
    procurementController.getReviewDrafts
);

router.get(
    '/drafts-history',
    verifyToken,
    checkRole('kaprodi'),
    procurementController.getHistoryDrafts
);

router.get(
    '/drafts/:id',
    verifyToken,
    procurementController.getDraftById
);

router.get(
    '/drafts/:draft_id/items',
    verifyToken,
    procurementController.getDraftItems
);

router.post(
    '/drafts/:draft_id/items',
    verifyToken,
    checkRole('kepala_lab'),
    procurementController.addItem
);

router.post(
    '/drafts/:id/submit',
    verifyToken,
    checkRole('kepala_lab'),
    procurementController.submitDraft
);

router.put(
    '/drafts/:draft_id/finalize',
    verifyToken,
    checkRole('kaprodi'),
    procurementController.finalizeDraft
);

// ✅ GET - ambil item by id (untuk halaman edit)
router.get(
    '/items/:item_id',
    verifyToken,
    checkRole('kepala_lab'),
    procurementController.getItemById
);

// ✅ PUT - update item
router.put(
    '/items/:item_id',
    verifyToken,
    checkRole('kepala_lab'),
    procurementController.updateItem
);

// ✅ DELETE - hapus item
router.delete(
    '/items/:item_id',
    verifyToken,
    checkRole('kepala_lab'),
    procurementController.deleteItem
);

router.put(
    '/items/:item_id/approve',
    verifyToken,
    checkRole('kaprodi'),
    procurementController.approveItem
);

router.put(
    '/items/:item_id/reject',
    verifyToken,
    checkRole('kaprodi'),
    procurementController.rejectItem
);

// PUT - update draft
router.put(
    '/drafts/:id',
    verifyToken,
    checkRole('kepala_lab'),
    procurementController.updateDraft
);

// DELETE - hapus draft
router.delete(
    '/drafts/:id',
    verifyToken,
    checkRole('kepala_lab'),
    procurementController.deleteDraft
);

module.exports = router;