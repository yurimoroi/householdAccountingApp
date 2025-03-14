export const createDateSummary = (items) => {
    return items.reduce((acc, item) => {
        const day = item.create_dt;
        if (!acc[day]) {
            acc[day] = {
                income: 0,
                expense: 0,
                balance: 0,
            };
        }

        if (item.type === "income") {
            acc[day].income += item.amount;
        } else {
            acc[day].expense += item.amount;
        }

        acc[day].balance = acc[day].income - acc[day].expense;

        return acc;
    }, {});
};
