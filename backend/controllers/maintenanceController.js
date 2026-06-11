const db = require('../config/db');

exports.createMaintenance = (req, res) => {

    const {
        inventory_id,
        tanggal,
        kondisi_sebelum,
        kondisi_sesudah,
        catatan,
        materials
    } = req.body;

    const user_id = req.user.id;

    db.query(
        `
        INSERT INTO maintenance_logs
        (
            inventory_id,
            user_id,
            tanggal,
            kondisi_sebelum,
            kondisi_sesudah,
            catatan
        )
        VALUES (?,?,?,?,?,?)
        `,
        [
            inventory_id,
            user_id,
            tanggal,
            kondisi_sebelum,
            kondisi_sesudah,
            catatan
        ],
        (err, result) => {

            if(err)
                return res.status(500).json(err);

            const maintenanceId =
                result.insertId;

            if(materials){

                materials.forEach(item => {

                    db.query(
                        `
                        INSERT INTO maintenance_materials
                        (
                            maintenance_id,
                            bhp_id,
                            jumlah
                        )
                        VALUES (?,?,?)
                        `,
                        [
                            maintenanceId,
                            item.bhp_id,
                            item.jumlah
                        ]
                    );

                    db.query(
                        `
                        UPDATE bhp_items
                        SET stok=stok-?
                        WHERE id=?
                        `,
                        [
                            item.jumlah,
                            item.bhp_id
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
                            item.bhp_id,
                            'maintenance',
                            item.jumlah,
                            `Maintenance #${maintenanceId}`
                        ]
                    );

                });

            }

            db.query(
                `
                UPDATE inventories
                SET kondisi=?
                WHERE id=?
                `,
                [
                    kondisi_sesudah,
                    inventory_id
                ]
            );

            res.json({
                message:
                'Maintenance berhasil dicatat'
            });

        }
    );

};

exports.getMaintenances = (req,res)=>{

    db.query(
        `
        SELECT
            ml.*,
            i.kode_inventaris,
            i.nama_barang
        FROM maintenance_logs ml
        JOIN inventories i
        ON ml.inventory_id=i.id
        ORDER BY ml.id DESC
        `,
        (err,result)=>{

            if(err)
                return res.status(500).json(err);

            res.json(result);

        }
    );

};

exports.getMaintenanceDetail = (req,res)=>{

    const { id } =
    req.params;

    db.query(
        `
        SELECT *
        FROM maintenance_logs
        WHERE id=?
        `,
        [id],
        (err,result)=>{

            if(err)
                return res.status(500).json(err);

            if(result.length===0)
                return res.status(404).json({
                    message:'Data tidak ditemukan'
                });

            const maintenance =
                result[0];

            db.query(
                `
                SELECT
                    mm.*,
                    b.nama_barang
                FROM maintenance_materials mm
                JOIN bhp_items b
                ON mm.bhp_id=b.id
                WHERE mm.maintenance_id=?
                `,
                [id],
                (err2,materials)=>{

                    if(err2)
                        return res.status(500).json(err2);

                    maintenance.materials =
                        materials;

                    res.json(maintenance);

                }
            );

        }
    );

};

