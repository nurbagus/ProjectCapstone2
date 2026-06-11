require("dotenv").config();

const express = require("express");
const cors = require("cors");

const authRoutes = require("./routes/authRoutes");
const testRoutes = require('./routes/testRoutes');
const userRoutes = require('./routes/userRoutes');
const roomRoutes = require('./routes/roomRoutes');
const procurementRoutes = require('./routes/procurementRoutes');
const inventoryRoutes = require('./routes/inventoryRoutes');
const bhpRoutes = require('./routes/bhpRoutes');
const maintenanceRoutes = require('./routes/maintenanceRoutes');

const app = express();

app.use(cors({
    origin: '*',
    methods: ['GET', 'POST', 'PUT', 'DELETE'],
    allowedHeaders: ['Content-Type', 'Authorization']
}));
app.use(express.json());

app.get("/", (req, res) => {
    res.send("API Running");
});

app.use("/api", authRoutes);
app.use('/api', testRoutes);
app.use('/api', userRoutes);
app.use('/api', roomRoutes);
app.use('/api', procurementRoutes);
app.use('/api', inventoryRoutes);
app.use('/api', bhpRoutes);
app.use('/api', maintenanceRoutes);
app.use('/uploads', express.static('uploads'));


app.listen(process.env.PORT, () => {
    console.log(
        `Server running on port ${process.env.PORT}`
    );
});