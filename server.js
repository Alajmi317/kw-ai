import express from "express";
import cors from "cors";
import OpenAI from "openai";

const app = express();
app.use(cors());
app.use(express.json());

// ضع مفتاح API حقك هنا
const client = new OpenAI({
  apiKey: "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"
});

app.post("/kwai", async (req, res) => {
  try {
    const userMessage = req.body.message;

    const response = await client.chat.completions.create({
      model: "gpt-4o-mini",
      messages: [
        { role: "system", content: "انت مساعد اسمه Kwai" },
        { role: "user", content: userMessage }
      ]
    });

    res.json({
      reply: response.choices[0].message.content
    });

  } catch (err) {
    res.json({ reply: "خطأ في الاتصال بالـ API" });
  }
});

app.listen(3000, () => console.log("Kwai API server running on port 3000"));
