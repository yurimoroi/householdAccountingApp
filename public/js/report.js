import { createMonthlySummary } from "./util/createMonthlySummary.js";
import { formatMonth } from "./util/formatDate.js";
import { formatSpreadMonry } from "./util/formatMoney.js";

window.addEventListener("DOMContentLoaded", () => {
    initMonth(formatMonth(new Date()));
    initPieChart(formatMonth(new Date()), "expense");
    initBarChart(formatMonth(new Date()));
    initMonthlySummary(formatMonth(new Date()));
    initTable(formatMonth(new Date()));
    pagenation(formatMonth(new Date()));
});

const initMonth = (month) => {
    document.querySelector('.e-month .e-input input[type="month"]').value =
        month;
};

const onPreviousNextBtn = () => {
    const previousBtn = document.querySelector(".e-month .e-btn.previous");
    const nextBtn = document.querySelector(".e-month .e-btn.next");
    const month = document.querySelector(
        '.e-month .e-input input[type="month"]'
    );

    previousBtn.addEventListener("click", () => {
        const date = new Date(`${month.value}-01`);
        date.setMonth(date.getMonth() - 1);

        month.value = formatMonth(date);
        initMonthlySummary(formatMonth(date));
        initPieChart(formatMonth(date), "expense");
        initBarChart(formatMonth(date));
        initTable(formatMonth(date));
        resetCheck();
        pagenation(formatMonth(date));
    });
    nextBtn.addEventListener("click", () => {
        const date = new Date(`${month.value}-01`);
        date.setMonth(date.getMonth() + 1);

        month.value = formatMonth(date);
        initMonthlySummary(formatMonth(date));
        initPieChart(formatMonth(date), "expense");
        initBarChart(formatMonth(date));
        initTable(formatMonth(date));
        resetCheck();
        pagenation(formatMonth(date));
    });
};

const valicationMonth = () => {
    const month = document.querySelector(
        '.e-month .e-input input[type="month"]'
    );

    month.addEventListener("change", () => {
        month.value === "" && initMonth(formatMonth(new Date()));
        initMonthlySummary(month.value);
        initTable(month.value);
    });
};

const changeType = () => {
    const selectBox = document.querySelector(".e-chart .e-pie select");
    const month = document.querySelector(
        '.e-month .e-input input[type="month"]'
    );

    selectBox.addEventListener("change", () => {
        initPieChart(month.value, selectBox.value);
    });
};

const initPieChart = (month, type) => {
    const pieDiv = document.querySelector(".e-pie .e-pie");
    pieDiv.innerHTML = "";

    const monthlySummary = items.filter((item) =>
        item.create_dt.startsWith(month)
    );

    const categorySummary = monthlySummary.reduce((acc, data) => {
        const category = data.name;
        if (!acc[category]) {
            acc[category] = {
                type: "",
                amount: 0,
            };
        }

        acc[category].type = data.type;
        acc[category].amount += data.amount;

        return acc;
    }, []);

    const key = Object.keys(categorySummary).filter((item) => {
        const filterCategories = categories.filter(
            (data) => data.type === type
        );

        return filterCategories.some((cat) => cat.name === item);
    });

    const data = Object.values(categorySummary)
        .filter((item) => item.type === type)
        .map((item) => item.amount);

    if (key.length === 0) {
        pieDiv.innerHTML = "Data is not found.";
    } else {
        const pie = document.createElement("canvas");
        pie.id = "pie";
        pieDiv.appendChild(pie);

        new Chart(pie, {
            type: "pie",
            data: {
                labels: key,
                datasets: [
                    {
                        data,
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    }
};

const initBarChart = (month) => {
    const summary = items
        .filter((item) => {
            return item.create_dt.startsWith(month);
        })
        .reduce((acc, item) => {
            const day = item.create_dt;
            if (!acc[day]) {
                acc[day] = {
                    income: 0,
                    expense: 0,
                };
            }

            if (item.type === "income") {
                acc[day].income += item.amount;
            } else {
                acc[day].expense += item.amount;
            }

            return acc;
        }, []);

    const barDiv = document.querySelector(".e-bar");
    barDiv.innerHTML = "";

    if (Object.keys(summary).length === 0) {
        barDiv.innerHTML = "Data is not found.";
    } else {
        const bar = document.createElement("canvas");
        bar.id = "bar";
        barDiv.appendChild(bar);

        new Chart(bar, {
            type: "bar",
            data: {
                labels: Object.keys(summary),
                datasets: [
                    {
                        label: "Income",
                        data: Object.values(summary).map((item) => item.income),
                        borderWidth: 1,
                    },
                    {
                        label: "Expense",
                        data: Object.values(summary).map(
                            (item) => item.expense
                        ),
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    }
};

const initMonthlySummary = (month) => {
    const summary = createMonthlySummary(month);

    const income = document.querySelector(
        ".e-monthly-report .e-cards .e-card.income .e-amount"
    );
    const expense = document.querySelector(
        ".e-monthly-report .e-cards .e-card.expense .e-amount"
    );
    const balance = document.querySelector(
        ".e-monthly-report .e-cards .e-card.balance .e-amount"
    );

    income.textContent = formatSpreadMonry(summary.income);
    expense.textContent = formatSpreadMonry(summary.expense);
    balance.textContent = formatSpreadMonry(summary.balance);
};

const initTable = (month) => {
    const monthlySummary = items.filter((item) =>
        item.create_dt.startsWith(month)
    );
    const tableBody = document.querySelector(".e-report-table .e-body");
    tableBody.innerHTML = "";

    monthlySummary.forEach((item) => {
        const tr = document.createElement("tr");
        const checkTd = document.createElement("td");
        const dateTd = document.createElement("td");
        const categoryTd = document.createElement("td");
        const amountTd = document.createElement("td");
        const contentTd = document.createElement("td");
        const idTd = document.createElement("td");
        const checkbox = document.createElement("input");

        idTd.className = "hidden";

        checkbox.type = "checkbox";

        dateTd.textContent = item.create_dt;
        categoryTd.textContent = item.name;
        amountTd.textContent = formatSpreadMonry(item.amount);
        contentTd.textContent = item.content;
        idTd.textContent = item.id;

        tr.addEventListener("click", (e) => {
            onRecord(e);
        });

        checkTd.appendChild(checkbox);
        tr.appendChild(checkTd);
        tr.appendChild(dateTd);
        tr.appendChild(categoryTd);
        tr.appendChild(amountTd);
        tr.appendChild(contentTd);
        tr.appendChild(idTd);

        tableBody.appendChild(tr);
    });

    changeTr(0, monthlySummary.length < 5 ? monthlySummary.length : 5);
};

const changeTr = (start, end) => {
    const trs = document.querySelectorAll(".e-report-table .e-body tr");

    trs.forEach((tr) => {
        tr.classList.remove("active");
    });

    for (let i = start; i < end; i++) {
        trs[i].classList.add("active");
    }
};

const resetCheck = () => {
    const titleCheckbox = document.querySelector(
        ".e-report-table .e-head input"
    );

    titleCheckbox.checked = false;
    changeTableTitle();
};

const onTitleChcekbox = () => {
    const titleCheckbox = document.querySelector(
        ".e-report-table .e-head input"
    );

    titleCheckbox.addEventListener("click", () => {
        const trs = document.querySelectorAll(".e-report-table .e-body tr");

        trs.forEach((tr) => {
            tr.querySelector('input[type="checkbox"]').checked =
                titleCheckbox.checked;
        });

        changeTableTitle();
    });
};

const onRecord = (e) => {
    const checkbox = e.currentTarget.querySelector('input[type="checkbox"]');
    if (e.target !== checkbox) {
        checkbox.checked = !checkbox.checked;
    }
    changeTableTitle();
};

const changeTableTitle = () => {
    const trs = document.querySelectorAll(".e-report-table .e-body tr");
    let num = 0;
    trs.forEach((tr) => {
        if (tr.querySelector('input[type="checkbox"]').checked) {
            num++;
        }
    });

    const title = document.querySelector(
        ".e-monthly-report .e-titles .e-title"
    );
    const trush = document.querySelector(".e-monthly-report .e-deletes");
    const titleCheckbox = document.querySelector(
        ".e-report-table .e-head input"
    );

    if (num) {
        title.classList.remove("active");
        trush.classList.add("active");

        const select = trush.querySelector(".e-select");
        select.textContent = `${num} selected`;

        if (trs.length === num) {
            titleCheckbox.checked = true;
        } else {
            titleCheckbox.checked = false;
        }
    } else {
        title.classList.add("active");
        trush.classList.remove("active");
    }
};

const pagenation = (month) => {
    const pageNum = document.querySelector("#page-num").value;
    const previousBtn = document.querySelector(
        ".e-pagenation .e-btns .e-btn.previous"
    );
    const nextBtn = document.querySelector(".e-pagenation .e-btns .e-btn.next");
    const monthlySummary = items.filter((item) =>
        item.create_dt.startsWith(month)
    );

    if (pageNum === "0") {
        previousBtn.classList.add("disable");

        if (5 < monthlySummary.length) {
            nextBtn.classList.remove("disable");
        }
    } else {
        previousBtn.classList.remove("disable");

        if (monthlySummary.length - (Number(pageNum) * 5 + 5) <= 0) {
            nextBtn.classList.add("disable");
        } else {
            nextBtn.classList.remove("disable");
        }
    }

    if (monthlySummary.length < 6) {
        previousBtn.classList.add("disable");
        nextBtn.classList.add("disable");
    }
};

const onPreviousNext = () => {
    const pageNum = document.querySelector("#page-num");
    const previousBtn = document.querySelector(
        ".e-pagenation .e-btns .e-btn.previous"
    );
    const nextBtn = document.querySelector(".e-pagenation .e-btns .e-btn.next");

    previousBtn.addEventListener("click", () => {
        const month = document.querySelector(
            '.e-month .e-input input[type="month"]'
        ).value;
        const monthlySummary = items.filter((item) =>
            item.create_dt.startsWith(month)
        );

        pageNum.value = Number(pageNum.value) - 1;
        pagenation(month);
        changeTr(
            Number(pageNum.value) * 5,
            monthlySummary.length < Number(pageNum.value) * 5 + 5
                ? monthlySummary.length
                : Number(pageNum.value) * 5 + 5
        );
    });
    nextBtn.addEventListener("click", () => {
        const month = document.querySelector(
            '.e-month .e-input input[type="month"]'
        ).value;
        const monthlySummary = items.filter((item) =>
            item.create_dt.startsWith(month)
        );

        pageNum.value = Number(pageNum.value) + 1;
        pagenation(month);
        changeTr(
            Number(pageNum.value) * 5,
            monthlySummary.length < Number(pageNum.value) * 5 + 5
                ? monthlySummary.length
                : Number(pageNum.value) * 5 + 5
        );
    });
};

const onDelete = () => {
    const trushbox = document.querySelector(".e-monthly-report .e-deletes svg");

    trushbox.addEventListener("click", async () => {
        const trs = document.querySelectorAll(".e-report-table .e-body tr");

        const deletes = [];

        trs.forEach((tr) => {
            tr.querySelector('input[type="checkbox"]').checked &&
                deletes.push(tr.querySelector(".hidden").textContent);
        });

        const data = {
            id: deletes,
        };

        const csrfToken = getCsrfToken();

        const res = await fetch("/delete", {
            method: "post",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(data),
        });

        if (!res.ok) {
            const text = await res.text();
            throw new Error(`HTTPエラー: ${res.status}\n${text}`);
        }
        const result = await res.json();
        items = result;

        const month = document.querySelector(
            '.e-month .e-input input[type="month"]'
        );

        initMonth(month.value);
        initPieChart(month.value, "expense");
        initBarChart(month.value);
        initMonthlySummary(month.value);
        initTable(month.value);
        pagenation(month.value);
        resetCheck();
    });
};

onPreviousNextBtn();
valicationMonth();
changeType();
onTitleChcekbox();
onPreviousNext();
onDelete();
