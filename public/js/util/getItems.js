let data = [];
let datePerData = {};

window.addEventListener("DOMContentLoaded", () => {
    const getItems = async () => {
        try {
            const res = await fetch("../json/items.json");
            if (!res.ok) {
                throw new Error(`HTTPエラー: ${res.status}`);
            }
            data = await res.json();
            data = data[0].items;

            datePerData = data.reduce((acc, item) => {
                const day = item.create_dt;
                if (!acc[day]) {
                    acc[day] = { income: 0, expense: 0, balance: 0 };
                }

                if (item.type === "income") {
                    acc[day].income += item.amount;
                } else {
                    acc[day].expense += item.amount;
                }

                acc[day].balance = acc[day].income - acc[day].expense;

                return acc;
            }, {});
        } catch (e) {
            console.error("エラーが発生しました:", e);
        }
    };

    getItems().then();
});
