    const db = require('../config/db');

    exports.createDraft = (req, res) => {

        const {
            judul,
            tahun
        } = req.body;

        const created_by =
            req.user.id;

        db.query(
            `
            INSERT INTO procurement_drafts
            (
                judul,
                tahun,
                created_by
            )
            VALUES (?, ?, ?)
            `,
            [
                judul,
                tahun,
                created_by
            ],
            (err, result) => {

                if(err)
                    return res.status(500).json(err);

                res.json({
                    message:
                    'Draft berhasil dibuat'
                });

            }
        );

    };

    exports.getDrafts = (req, res) => {

        db.query(
            `
            SELECT
                pd.*,
                u.nama
            FROM procurement_drafts pd
            JOIN users u
            ON pd.created_by=u.id
            ORDER BY pd.id DESC
            `,
            (err,result)=>{

                if(err)
                    return res.status(500).json(err);

                res.json(result);

            }
        );

    };

    exports.getDraftById = (req, res) => {

        const { id } = req.params;

        db.query(
            `
            SELECT
                pd.*,
                u.nama
            FROM procurement_drafts pd
            JOIN users u ON pd.created_by = u.id
            WHERE pd.id = ?
            `,
            [id],
            (err, result) => {

                if (err)
                    return res.status(500).json(err);

                if (result.length === 0) {
                    return res.status(404).json({
                        message: 'Draft tidak ditemukan'
                    });
                }

                res.json(result[0]);

            }
        );

    };

    exports.addItem = (req,res)=>{

        const { draft_id } =
        req.params;

        const {
            jenis_barang,
            nama_barang,
            jumlah,
            harga_satuan,
            link_pembelian,
            replace_inventory_id
        } = req.body;

        db.query(
            `
            INSERT INTO procurement_items
            (
                draft_id,
                jenis_barang,
                nama_barang,
                jumlah,
                harga_satuan,
                link_pembelian,
                replace_inventory_id
            )
            VALUES (?,?,?,?,?,?,?)
            `,
            [
                draft_id,
                jenis_barang,
                nama_barang,
                jumlah,
                harga_satuan ?? 0,
                link_pembelian,
                replace_inventory_id
            ],
            (err,result)=>{

                if(err)
                    return res.status(500).json(err);

                res.json({
                    message:
                    'Item berhasil ditambahkan'
                });

            }
        );

    };

    exports.getDraftItems = (req,res)=>{

        const { draft_id } =
        req.params;

        db.query(
            `
            SELECT *
            FROM procurement_items
            WHERE draft_id=?
            `,
            [draft_id],
            (err,result)=>{

                if(err)
                    return res.status(500).json(err);

                res.json(result);

            }
        );

    };

    exports.submitDraft = (req,res)=>{

        const { id } =
        req.params;

        db.query(
            `
            UPDATE procurement_drafts
            SET status='review'
            WHERE id=?
            `,
            [id],
            (err,result)=>{


                if(err)
                    return res.status(500).json(err);

                res.json({
                    message:
                    'Draft dikirim ke Kaprodi'
                });

            }
        );

    };

    exports.getReviewDrafts = (req, res) => {

        db.query(
            `
            SELECT
                pd.*,
                u.nama
            FROM procurement_drafts pd
            JOIN users u
            ON pd.created_by = u.id
            WHERE pd.status='review'
            ORDER BY pd.id DESC
            `,
            (err, result) => {

                if(err)
                    return res.status(500).json(err);

                res.json(result);

            }
        );

    };

    exports.approveItem = (req,res)=>{

        const { item_id } =
        req.params;

        db.query(
            `
            UPDATE procurement_items
            SET status_review='approved'
            WHERE id=?
            `,
            [item_id],
            (err,result)=>{

                if(err)
                    return res.status(500).json(err);

                res.json({
                    message:
                    'Item disetujui'
                });

            }
        );

    };

    exports.rejectItem = (req,res)=>{

        const { item_id } =
        req.params;

        db.query(
            `
            UPDATE procurement_items
            SET status_review='rejected'
            WHERE id=?
            `,
            [item_id],
            (err,result)=>{

                if(err)
                    return res.status(500).json(err);

                res.json({
                    message:
                    'Item ditolak'
                });

            }
        );

    };

    exports.finalizeDraft = (req,res)=>{

        const { draft_id } =
        req.params;

        db.query(
            `
            UPDATE procurement_drafts
            SET status='locked'
            WHERE id=?
            `,
            [draft_id],
            (err,result)=>{

                if(err)
                    return res.status(500).json(err);

                res.json({
                    message:
                    'Draft berhasil difinalisasi'
                });

            }
        );

    };
    exports.getHistoryDrafts = (req, res) => {

    db.query(
        `
        SELECT
            pd.*,
            u.nama
        FROM procurement_drafts pd
        JOIN users u
        ON pd.created_by = u.id
        WHERE pd.status IN ('locked', 'approved')
        ORDER BY pd.id DESC
        `,
        (err, result) => {

            if(err)
                return res.status(500).json(err);

            res.json(result);

        }
    );

};
exports.updateItem = (req, res) => {

    const { item_id } = req.params;

    const {
        nama_barang,
        jumlah,
        harga_satuan,
        link_pembelian
    } = req.body;

    db.query(
        `
        UPDATE procurement_items
        SET nama_barang=?,
            jumlah=?,
            harga_satuan=?,
            link_pembelian=?
        WHERE id=?
        `,
        [
            nama_barang,
            jumlah,
            harga_satuan,
            link_pembelian,
            item_id
        ],
        (err, result) => {

            if (err)
                return res.status(500).json(err);

            res.json({
                message:
                'Item berhasil diupdate'
            });

        }
    );

};
exports.getItemById = (req, res) => {

    const { item_id } = req.params;

    db.query(
        `SELECT * FROM procurement_items WHERE id=?`,
        [item_id],
        (err, result) => {

            if (err)
                return res.status(500).json(err);

            if (result.length === 0)
                return res.status(404).json({
                    message: 'Item tidak ditemukan'
                });

            res.json(result[0]);

        }
    );

};
exports.deleteItem = (req, res) => {

    const { item_id } = req.params;

    db.query(
        `DELETE FROM procurement_items WHERE id=?`,
        [item_id],
        (err, result) => {

            if (err)
                return res.status(500).json(err);

            res.json({
                message:
                'Item berhasil dihapus'
            });

        }
    );

};

exports.updateDraft = (req, res) => {

    const { id } = req.params;

    const {
        judul,
        tahun
    } = req.body;

    db.query(
        `
        UPDATE procurement_drafts
        SET judul=?,
            tahun=?
        WHERE id=?
        AND status IN ('draft', 'submitted')
        `,
        [
            judul,
            tahun,
            id
        ],
        (err, result) => {

            if (err)
                return res.status(500).json(err);

            if (result.affectedRows === 0)
                return res.status(403).json({
                    message:
                    'Draft tidak ditemukan atau tidak bisa diedit'
                });

            res.json({
                message:
                'Draft berhasil diupdate'
            });

        }
    );

};

exports.deleteDraft = (req, res) => {

    const { id } = req.params;

    db.query(
        `
        DELETE FROM procurement_drafts
        WHERE id=?
        AND status='draft'
        `,
        [id],
        (err, result) => {

            if (err)
                return res.status(500).json(err);

            if (result.affectedRows === 0)
                return res.status(403).json({
                    message:
                    'Draft tidak ditemukan atau tidak bisa dihapus'
                });

            res.json({
                message:
                'Draft berhasil dihapus'
            });

        }
    );

};