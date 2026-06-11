const db = require('../config/db');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');

exports.register = async (req, res) => {
    try {
        const { nama, email, password, role } = req.body;

        const hashedPassword = await bcrypt.hash(password, 10);

        const sql = `
            INSERT INTO users (nama, email, password, role)
            VALUES (?, ?, ?, ?)
        `;

        db.query(
            sql,
            [nama, email, hashedPassword, role],
            (err, result) => {
                if (err) {
                    return res.status(500).json(err);
                }

                res.json({
                    message: 'User berhasil dibuat'
                });
            }
        );

    } catch (error) {
        res.status(500).json(error);
    }
};


exports.login = (req, res) => {

    const { email, password } = req.body;

    const sql = `
        SELECT *
        FROM users
        WHERE email = ?
    `;

    db.query(sql, [email], async (err, result) => {

        if (err) {
            return res.status(500).json(err);
        }

        if (result.length === 0) {
            return res.status(401).json({
                message: 'Email tidak ditemukan'
            });
        }

        const user = result[0];

        const validPassword =
            await bcrypt.compare(password, user.password);

        if (!validPassword) {
            return res.status(401).json({
                message: 'Password salah'
            });
        }

        const token = jwt.sign(
            {
                id: user.id,
                role: user.role
            },
            process.env.JWT_SECRET,
            {
                expiresIn: '1d'
            }
        );

        res.json({
            message: 'Login berhasil',
            token,
            user: {
                id: user.id,
                nama: user.nama,
                email: user.email,
                role: user.role
            }
        });

    });
};