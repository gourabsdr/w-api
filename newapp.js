const express = require("express");
const { Client } = require("whatsapp-web.js");
const qrcode = require("qrcode");

const app = express();
const port = 7000;

const clients = {};
const qrCodes = {}; // Store QR codes for each session

// Function to create a new WhatsApp client
function createClient(sessionId) {
    if (clients[sessionId]) {
        return { status: "error", message: "Session already exists" };
    }

    const client = new Client({
        puppeteer: {
            args: ['--no-sandbox', '--disable-setuid-sandbox'],
        },
    });

    clients[sessionId] = client;

    client.on("qr", (qr) => {
        console.log(`📱 Scan this QR code for WhatsApp Session: ${sessionId}`);

        qrcode.toDataURL(qr, (err, url) => {
            if (!err) {
                qrCodes[sessionId] = url;
            }
        });
    });

    client.on("ready", () => {
        console.log(`✅ WhatsApp Session ${sessionId} is ready!`);
        delete qrCodes[sessionId]; // Remove QR after login
    });

    client.initialize();
    return { status: "success", message: `Session ${sessionId} created` };
}

// Function to format phone numbers correctly
function formatNumber(number) {
    let cleanedNumber = number.replace(/\D/g, ""); // Remove non-numeric characters

    if (cleanedNumber.length === 10) {
        cleanedNumber = "91" + cleanedNumber; // Add 91 for 10-digit numbers
    }
    // If more than 10 digits, assume it already includes country code and leave it as is
    return cleanedNumber;
}

// Function to get a random WhatsApp client
function getRandomClient() {
    const clientIds = Object.keys(clients);
    if (clientIds.length === 0) return null;
    const randomId = clientIds[Math.floor(Math.random() * clientIds.length)];
    return clients[randomId];
}

// Function to send messages
async function sendBulkMessages(numbers, message) {
    for (let number of numbers) {
        let formattedNumber = formatNumber(number);
        let chatId;

        if (formattedNumber.length === 12) {
            chatId = formattedNumber + "@c.us"; // Individual chat
        } else {
            chatId = formattedNumber + "@g.us"; // Group chat
        }

        try {
            const selectedClient = getRandomClient();
            if (!selectedClient) {
                console.log("❌ No active WhatsApp clients available.");
                return;
            }

            console.log(`📤 Sending message to ${formattedNumber} (${chatId}) using a random session`);

            if (chatId.endsWith("@c.us")) {
                const numberExists = await selectedClient.getNumberId(formattedNumber);
                if (!numberExists) {
                    console.log(`❌ ${formattedNumber} is NOT registered on WhatsApp.`);
                    continue;
                }
            }

            await selectedClient.sendMessage(chatId, message);
            console.log(`✅ Message sent to ${formattedNumber}`);
        } catch (error) {
            console.log(`❌ Failed to send to ${formattedNumber}:`, error.message);
        }

        await new Promise((resolve) => setTimeout(resolve, 5000)); // Delay to avoid spam detection
    }
}

// API to create a new WhatsApp session
app.get("/create-session", (req, res) => {
    const { session } = req.query;

    if (!session) {
        return res.status(400).json({ status: "error", message: "Session ID is required" });
    }

    const response = createClient(session);
    res.json(response);
});

// API to get QR code for a session
app.get("/get-qr", (req, res) => {
    const { session } = req.query;

    if (!session || !qrCodes[session]) {
        return res.json({ status: "error", message: "QR code not available or session does not exist" });
    }

    res.json({ status: "success", qr: qrCodes[session] });
});

// API to send bulk messages
app.get("/send", async (req, res) => {
    const { number, message } = req.query;

    if (!number || !message) {
        return res.status(400).json({ status: "error", message: "Missing number or message" });
    }

    const numbersArray = number.split(",").map(formatNumber);

    sendBulkMessages(numbersArray, message);

    res.json({ status: "success", message: "Bulk messages are being sent using multiple WhatsApp sessions!" });
});

// Start Express server
app.listen(port, () => {
    console.log(`🚀 Server running at http://localhost:${port}`);
});
