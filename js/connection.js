const express = require('express');
const http = require('http');
const WebSocket = require('ws');
const app = express();
const port = process.env.PORT || 3000;


app.use((req, res, next) => {
    if (req.headers.authorization === 'Bearer valid-token') {
        next();
    } else {
        res.status(403).send('Forbidden');
    }
});

const server = http.createServer(app);
const wss = new WebSocket.Server({ server });

// WebSocket connection
wss.on('connection', (ws) => {
    console.log('Client connected');
    
    ws.on('message', (message) => {
        console.log(`Received message: ${message}`);
        ws.send(`Server: ${message}`);
    });

    ws.on('close', () => {
        console.log('Client disconnected');
    });
});

app.get('/', (req, res) => {
    res.send('WebSocket server is running');
});

server.listen(port, () => {
    console.log(`Server is listening on port ${port}`);
});
