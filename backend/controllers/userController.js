const db = require('../config/db');
const bcrypt = require('bcrypt');

exports.getUsers = (req, res) => {

    db.query(
        'SELECT id,nama,email,role FROM users',
        (err, result) => {

            if (err)
                return res.status(500).json(err);

            res.json(result);

        }
    );

};

exports.createUser = async (req, res) => {

    const {
        nama,
        email,
        password,
        role
    } = req.body;

    const hashed =
    await bcrypt.hash(password, 10);

    db.query(
        `INSERT INTO users
        (nama,email,password,role)
        VALUES(?,?,?,?)`,
        [
            nama,
            email,
            hashed,
            role
        ],
        (err, result) => {

            if (err)
                return res.status(500).json(err);

            res.json({
                message:
                'User berhasil dibuat'
            });

        }
    );

};

exports.updateUser = async (req, res) => {

    const { id } = req.params;

    const { nama, email, role, password } = req.body;
    

    console.log('Body:', req.body);
    console.log('Password:', password);
    console.log('Password trim:', password ? password.trim() : 'kosong');

    // Kalau password diisi, hash lalu update sekalian
    if (password && password.trim() !== '') {

        const hashed = await bcrypt.hash(password, 10);

        db.query(
            `UPDATE users
             SET nama=?, email=?, role=?, password=?
             WHERE id=?`,
            [nama, email, role, hashed, id],
            (err, result) => {

                if (err)
                    return res.status(500).json(err);

                res.json({ message: 'User berhasil diupdate' });

            }
        );

    } else {

        // Password kosong, update tanpa ganti password
        db.query(
            `UPDATE users
             SET nama=?, email=?, role=?
             WHERE id=?`,
            [nama, email, role, id],
            (err, result) => {

                if (err)
                    return res.status(500).json(err);

                res.json({ message: 'User berhasil diupdate' });

            }
        );

    }

};

exports.deleteUser = (req, res) => {

    const { id } = req.params;

    db.query(
        'DELETE FROM users WHERE id=?',
        [id],
        (err, result) => {

            if (err)
                return res.status(500).json(err);

            res.json({
                message:
                'User berhasil dihapus'
            });

        }
    );

};