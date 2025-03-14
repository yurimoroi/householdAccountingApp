export const createMonthlySummary = (month) => {
    const monthlySummary = items.filter((item) =>
        item.create_dt.startsWith(month)
    );

    return monthlySummary.reduce(
        (acc, data) => {
            if (data.type === "income") {
                acc.income += data.amount;
            } else {
                acc.expense += data.amount;
            }

            acc.balance = acc.income - acc.expense;

            return acc;
        },
        {
            income: 0,
            expense: 0,
            balance: 0,
        }
    );
};
