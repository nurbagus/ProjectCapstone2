const db = require('../config/db');

exports.getRooms = (req, res) => {

    db.query(
        'SELECT * FROM rooms ORDER BY id DESC',
        (err, result) => {

            if (err)
                return res.status(500).json(err);

            res.json(result);
        }
    );

};

exports.createRoom = (req, res) => {

    const {
        nama_ruangan,
        lokasi,
        keterangan
    } = req.body;

    db.query(
        `
        INSERT INTO rooms
        (
            nama_ruangan,
            lokasi,
            keterangan
        )
        VALUES (?, ?, ?)
        `,
        [
            nama_ruangan,
            lokasi,
            keterangan
        ],
        (err, result) => {

            if (err)
                return res.status(500).json(err);

            res.json({
                message: 'Ruangan berhasil ditambahkan'
            });

        }
    );

};

exports.updateRoom = (req, res) => {

    const { id } = req.params;

    const {
        nama_ruangan,
        lokasi,
        keterangan
    } = req.body;

    db.query(
        `
        UPDATE rooms
        SET
            nama_ruangan=?,
            lokasi=?,
            keterangan=?
        WHERE id=?
        `,
        [
            nama_ruangan,
            lokasi,
            keterangan,
            id
        ],
        (err, result) => {

            if (err)
                return res.status(500).json(err);

            res.json({
                message: 'Ruangan berhasil diupdate'
            });

        }
    );

};

exports.deleteRoom = (req, res) => {

    const { id } = req.params;

    db.query(
        'DELETE FROM rooms WHERE id=?',
        [id],
        (err, result) => {

            if (err)
                return res.status(500).json(err);

            res.json({
                message: 'Ruangan berhasil dihapus'
            });

        }
    );

};