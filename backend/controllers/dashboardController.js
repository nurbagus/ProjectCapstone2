const db = require('../config/db');

exports.getStats = (req,res)=>{

    const data = {};

    db.query(
        'SELECT COUNT(*) total FROM users',
        (err,user)=>{

            data.users =
            user[0].total;

            db.query(
                'SELECT COUNT(*) total FROM rooms',
                (err,room)=>{

                    data.rooms =
                    room[0].total;

                    db.query(
                        'SELECT COUNT(*) total FROM inventories',
                        (err,inv)=>{

                            data.inventories =
                            inv[0].total;

                            db.query(
                                'SELECT COUNT(*) total FROM bhp_items',
                                (err,bhp)=>{

                                    data.bhp =
                                    bhp[0].total;

                                    res.json(data);

                                }
                            );

                        }
                    );

                }
            );

        }
    );

};

