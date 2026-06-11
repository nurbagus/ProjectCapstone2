const db = require('../config/db');

exports.createBhp = (req,res)=>{

    const {
        nama_barang,
        stok,
        satuan,
        harga,
        minimal_stok
    } = req.body;

    db.query(
        `
        INSERT INTO bhp_items
        (
            nama_barang,
            stok,
            satuan,
            harga,
            minimal_stok
        )
        VALUES (?,?,?,?,?)
        `,
        [
            nama_barang,
            stok,
            satuan,
            harga,
            minimal_stok
        ],
        (err,result)=>{

            if(err)
                return res.status(500).json(err);

            res.json({
                message:
                'BHP berhasil ditambahkan'
            });

        }
    );

};

exports.getBhp = (req,res)=>{

    db.query(
        `
        SELECT *
        FROM bhp_items
        ORDER BY id DESC
        `,
        (err,result)=>{

            if(err)
                return res.status(500).json(err);

            res.json(result);

        }
    );

};

exports.stockIn = (req,res)=>{

    const { id } =
    req.params;

    const {
        jumlah,
        keterangan
    } = req.body;

    db.query(
        `
        UPDATE bhp_items
        SET stok=stok+?
        WHERE id=?
        `,
        [
            jumlah,
            id
        ],
        (err,result)=>{

            if(err)
                return res.status(500).json(err);

            db.query(
                `
                INSERT INTO bhp_stock_logs
                (
                    bhp_id,
                    jenis,
                    jumlah,
                    keterangan
                )
                VALUES (?,?,?,?)
                `,
                [
                    id,
                    'masuk',
                    jumlah,
                    keterangan
                ]
            );

            res.json({
                message:
                'Stok berhasil ditambah'
            });

        }
    );

};

exports.stockOut = (req,res)=>{

    const { id } =
    req.params;

    const {
        jumlah,
        keterangan
    } = req.body;

    db.query(
        `
        SELECT *
        FROM bhp_items
        WHERE id=?
        `,
        [id],
        (err,result)=>{

            if(err)
                return res.status(500).json(err);

            if(result[0].stok < jumlah){

                return res.status(400).json({
                    message:
                    'Stok tidak cukup'
                });

            }

            db.query(
                `
                UPDATE bhp_items
                SET stok=stok-?
                WHERE id=?
                `,
                [
                    jumlah,
                    id
                ]
            );

            db.query(
                `
                INSERT INTO bhp_stock_logs
                (
                    bhp_id,
                    jenis,
                    jumlah,
                    keterangan
                )
                VALUES (?,?,?,?)
                `,
                [
                    id,
                    'keluar',
                    jumlah,
                    keterangan
                ]
            );

            res.json({
                message:
                'Stok berhasil dikurangi'
            });

        }
    );

};

exports.getLogs = (req,res)=>{

    db.query(
        `
        SELECT
            l.*,
            b.nama_barang
        FROM bhp_stock_logs l
        JOIN bhp_items b
        ON l.bhp_id=b.id
        ORDER BY l.id DESC
        `,
        (err,result)=>{

            if(err)
                return res.status(500).json(err);

            res.json(result);

        }
    );

};

exports.lowStock = (req,res)=>{

    db.query(
        `
        SELECT *
        FROM bhp_items
        WHERE stok <= minimal_stok
        `,
        (err,result)=>{

            if(err)
                return res.status(500).json(err);

            res.json(result);

        }
    );

};

