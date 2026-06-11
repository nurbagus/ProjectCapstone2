const db = require('../config/db');
const QRCode = require('qrcode');
const path = require('path');

exports.createInventory = async (req, res) => {

    try {

        const {
            nama_barang,
            jumlah,
            harga,
            room_id,
            tanggal_pembelian,
            tanggal_penerimaan
        } = req.body;

        db.query(
            `
            SELECT COUNT(*) total
            FROM inventories
            `,
            async (err, result) => {

                if (err)
                    return res.status(500).json(err);

                const nextNumber =
                    result[0].total + 1;

                const kodeInventaris =
                    `INV-2026-${String(nextNumber).padStart(4,'0')}`;

                const qrPath =
                    `uploads/qr/${kodeInventaris}.png`;

                await QRCode.toFile(
                    qrPath,
                    `http://localhost:8000/inventory/${nextNumber}`
                );

                db.query(
                    `
                    INSERT INTO inventories
                    (
                        kode_inventaris,
                        nama_barang,
                        jumlah,
                        harga,
                        room_id,
                        tanggal_pembelian,
                        tanggal_penerimaan,
                        barcode
                    )
                    VALUES (?,?,?,?,?,?,?,?)
                    `,
                    [
                        kodeInventaris,
                        nama_barang,
                        jumlah,
                        harga,
                        room_id,
                        tanggal_pembelian,
                        tanggal_penerimaan,
                        qrPath
                    ],
                    (err,result)=>{

                        if(err)
                            return res.status(500).json(err);

                        res.json({
                            message:
                            'Inventaris berhasil dibuat',
                            kodeInventaris
                        });

                    }
                );

            }
        );

    } catch(error){

        res.status(500).json(error);

    }

};

exports.getInventories = (req,res)=>{

    db.query(
        `
        SELECT
            i.*,
            r.nama_ruangan
        FROM inventories i
        LEFT JOIN rooms r
        ON i.room_id=r.id
        ORDER BY i.id DESC
        `,
        (err,result)=>{

            if(err)
                return res.status(500).json(err);

            res.json(result);

        }
    );

};

exports.getInventoryDetail = (req,res)=>{

    const { id } =
    req.params;

    db.query(
        `
        SELECT *
        FROM inventories
        WHERE id=?
        `,
        [id],
        (err,result)=>{

            if(err)
                return res.status(500).json(err);

            res.json(result[0]);

        }
    );

};

exports.updateCondition = (req,res)=>{

    const { id } =
    req.params;

    const { kondisi } =
    req.body;

    db.query(
        `
        UPDATE inventories
        SET kondisi=?
        WHERE id=?
        `,
        [
            kondisi,
            id
        ],
        (err,result)=>{

            if(err)
                return res.status(500).json(err);

            res.json({
                message:
                'Kondisi berhasil diupdate'
            });

        }
    );

};

exports.uploadPhoto = (req,res)=>{

    const { id } =
    req.params;

    const foto =
        req.file.filename;

    db.query(
        `
        UPDATE inventories
        SET foto=?
        WHERE id=?
        `,
        [
            foto,
            id
        ],
        (err,result)=>{

            if(err)
                return res.status(500).json(err);

            res.json({
                message:
                'Foto berhasil diupload'
            });

        }
    );

};