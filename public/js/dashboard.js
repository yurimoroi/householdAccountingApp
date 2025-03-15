import {
    getBalanceCard,
    getBalanceCardMini,
    getDetailHeaderDate,
    getForm,
    getInputDate,
    getInputForm,
    getInputType,
    getSubmitBtn,
    getToggleBtn,
    getCategoryIcon,
    getToggleModalBtn,
    getModalSubmitBtn,
    getModalInput,
    getModalInputNewModify,
    getModalInputType,
    getModalForm,
} from "./dashboardCommon.js";
import { formatDate, formatMonth } from "./util/formatDate.js";
import { createMonthlySummary } from "./util/createMonthlySummary.js";
import { formatSpreadMonry, formatStringToNumber } from "./util/formatMoney.js";

window.addEventListener("DOMContentLoaded", () => {
    initDate();
    initData(items);
    setCategory("expense");
    initMonthlySummary(formatMonth(new Date()));
    changeDetail(formatDate(new Date()));
});

const initMonthlySummary = (month) => {
    const summary = createMonthlySummary(month);

    const income = getBalanceCard("income");
    const expense = getBalanceCard("expense");
    const balance = getBalanceCard("balance");

    income.textContent = formatSpreadMonry(summary.income);
    expense.textContent = formatSpreadMonry(summary.expense);
    balance.textContent = formatSpreadMonry(summary.balance);
};

const initDate = () => {
    const titleDate = getDetailHeaderDate();
    const inputDate = getInputDate();
    const date = formatDate(new Date());

    titleDate.textContent = date;
    inputDate.value = date;
};

const setCategory = (type) => {
    const category = document.querySelector(
        '.e-form .e-input select[name="category"]'
    );
    category.innerHTML = "";
    let option = document.createElement("option");
    option.value = "";
    option.text = "";
    category.appendChild(option);

    const filterCategories = categories.filter((cat) => cat.type === type);

    filterCategories.forEach((cat) => {
        let option = document.createElement("option");
        option.value = cat.id;
        option.text = cat.name;
        category.appendChild(option);
    });
};

const onAddItem = () => {
    const addItem = document.querySelector(".e-add");
    const inputForm = getInputForm();
    const deleteSubmit = getSubmitBtn("delete");
    const titleDate = getDetailHeaderDate();

    addItem.addEventListener("click", () => {
        inputForm.classList.add("active");
        deleteSubmit.classList.remove("active");
        setInputForm({
            id: "",
            type: "expense",
            date: titleDate.textContent,
            category: "",
            amount: "",
            content: "",
        });
    });
};

const setInputForm = (datas) => {
    const { id, type, date, category, amount, content } = datas;

    type === "income" ? setIncome() : setExpense();

    const form = getForm();

    form.id.value = id;
    form.date.value = date;
    form.category.value = category;
    form.amount.value = amount;
    form.content.value = content;
};

const onCloseBtn = () => {
    const closeBtn = document.querySelector(".e-input-form .e-title svg");
    const inputForm = getInputForm();

    closeBtn.addEventListener("click", () => {
        inputForm.classList.remove("active");
    });
};

const toggleIncomeExpense = () => {
    const expenseBtn = getToggleBtn("expense");
    const incomeBtn = getToggleBtn("income");

    expenseBtn.addEventListener("click", () => {
        setExpense();
    });
    incomeBtn.addEventListener("click", () => {
        setIncome();
    });
};

const setIncome = () => {
    const incomeBtn = getToggleBtn("income");
    const expenseBtn = getToggleBtn("expense");
    const submitBtn = getSubmitBtn("save");
    const type = getInputType();
    type.value = "income";
    const categoryIcon = getCategoryIcon();

    incomeBtn.classList.add("active");
    expenseBtn.classList.remove("active");
    submitBtn.classList.remove("expense");
    submitBtn.classList.add("income");
    setCategory("income");
    categoryIcon.style.fill = "#1976d2";
};

const setExpense = () => {
    const incomeBtn = getToggleBtn("income");
    const expenseBtn = getToggleBtn("expense");
    const submitBtn = getSubmitBtn("save");
    const type = getInputType();
    type.value = "expense";
    const categoryIcon = getCategoryIcon();

    expenseBtn.classList.add("active");
    incomeBtn.classList.remove("active");
    submitBtn.classList.remove("income");
    submitBtn.classList.add("expense");
    setCategory("expense");
    categoryIcon.style.fill = "#F44335";
};

const valicationDate = () => {
    const date = getInputDate();
    const titleDate = getDetailHeaderDate();

    date.addEventListener("change", (e) => {
        date.value === ""
            ? initDate()
            : (titleDate.textContent = e.target.value);
    });
};

const changeDetail = (date) => {
    const income = getBalanceCardMini("income");
    const expense = getBalanceCardMini("expense");
    const balance = getBalanceCardMini("balance");

    if (datePerItems[date] !== undefined) {
        income.textContent = formatSpreadMonry(datePerItems[date].income);
        expense.textContent = formatSpreadMonry(datePerItems[date].expense);
        balance.textContent = formatSpreadMonry(datePerItems[date].balance);
    } else {
        income.textContent = "¥0";
        expense.textContent = "¥0";
        balance.textContent = "¥0";
    }

    const dateData = items.filter((d) => d.create_dt === date);

    const list = document.querySelector(".e-detail .e-right .e-list");
    list.innerHTML = "";

    dateData.forEach((d) => {
        const li = document.createElement("li");
        const spanC = document.createElement("span");
        const spanI = document.createElement("span");
        const pC = document.createElement("p");
        const pA = document.createElement("p");

        li.className = `e-list-card ${d.type}`;
        spanC.className = "e-category";
        spanI.className = "e-id";
        pC.className = "e-content";
        pA.className = "e-amount";

        spanC.textContent = d.category;
        spanI.textContent = d.id;
        pC.textContent = d.content;
        pA.textContent = formatSpreadMonry(d.amount);

        li.addEventListener("click", (e) => {
            onListItem(e);
        });

        li.appendChild(spanC);
        li.appendChild(spanI);
        li.appendChild(pC);
        li.appendChild(pA);

        list.appendChild(li);
    });
};

const onListItem = (e) => {
    const inputForm = getInputForm();

    const deleteSubmit = getSubmitBtn("delete");
    deleteSubmit.classList.add("active");
    inputForm.classList.add("active");

    const titleDate = getDetailHeaderDate();
    const id = e.currentTarget.querySelector(".e-id").textContent;
    const category = e.currentTarget.querySelector(".e-category").textContent;
    const amount = formatStringToNumber(
        e.currentTarget.querySelector(".e-amount").textContent
    );
    const content = e.currentTarget.querySelector(".e-content").textContent;

    setInputForm({
        id,
        type: e.currentTarget.classList[1],
        date: titleDate.textContent,
        category,
        amount,
        content,
    });
};

const initData = (data) => {
    items = data;

    datePerItems = items.reduce((acc, item) => {
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

    eventData = Object.keys(datePerItems).map((date) => {
        const { income, expense, balance } = datePerItems[date];

        return {
            start: date,
            income: formatSpreadMonry(income),
            expense: formatSpreadMonry(expense),
            balance: formatSpreadMonry(balance),
            backgroundColor: "transparent",
            borderColor: "transparent",
        };
    });

    let calendarEl = document.querySelector("#calendar");
    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        eventContent: (arg) => {
            const div = document.createElement("div");
            const incomeDiv = document.createElement("p");
            const expenseDiv = document.createElement("p");
            const balanceDiv = document.createElement("p");

            div.className = "event-box";
            incomeDiv.className = "event-income";
            expenseDiv.className = "event-expense";
            balanceDiv.className = "event-balance";

            incomeDiv.textContent = arg.event.extendedProps.income;
            expenseDiv.textContent = arg.event.extendedProps.expense;
            balanceDiv.textContent = arg.event.extendedProps.balance;

            div.appendChild(incomeDiv);
            div.appendChild(expenseDiv);
            div.appendChild(balanceDiv);

            let arrayOfDomNodes = [div];
            return { domNodes: arrayOfDomNodes };
        },
        events: [...eventData],
        dateClick: (info) => {
            document.querySelectorAll(".fc-day").forEach((ele) => {
                ele.classList.remove("active");
            });

            info.dayEl.classList.add("active");

            const date = getDetailHeaderDate();
            date.textContent = info.dateStr;

            changeDetail(info.dateStr);
        },
        datesSet: (info) => {
            initMonthlySummary(formatMonth(info.view.currentStart));

            if (formatDate(calendar.getDate()) === formatDate(new Date())) {
                const date = getDetailHeaderDate();
                date.textContent = formatDate(new Date());

                changeDetail(formatDate(new Date()));
            }
        },
    });
    calendar.render();
};

const onSave = () => {
    const form = getForm();
    const saveBtn = getSubmitBtn("save");

    saveBtn.addEventListener("click", async () => {
        const data = {
            id: form.id.value,
            type: form.type.value,
            date: form.date.value,
            category: form.category.value,
            amount: form.amount.value,
            content: form.content.value,
        };

        const csrfToken = getCsrfToken();

        const res = await fetch("/upsert", {
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
        const date = getDetailHeaderDate();

        initData(result);
        setCategory("expense");
        changeDetail(date.textContent);
        form.id.value = "";
        form.amount.value = "";
        form.content.value = "";
        date.textContent = form.date.value;
    });
};

const onDelete = () => {
    const form = getForm();
    const deleteBtn = getSubmitBtn("delete");

    deleteBtn.addEventListener("click", async () => {
        const data = {
            id: form.id.value,
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
        const date = getDetailHeaderDate();

        initData(result);
        setCategory("expense");
        changeDetail(date.textContent);
        form.id.value = "";
        form.amount.value = "";
        form.content.value = "";
        date.textContent = form.date.value;
    });
};

const onCategory = () => {
    const categoryIcon = getCategoryIcon();
    const modal = document.querySelector(".e-modal");

    categoryIcon.addEventListener("click", () => {
        modal.classList.toggle("active");
        setModalNew();
        setModalExpense();
        setModalCategory("expense");
    });
};

const onModal = () => {
    const modal = document.querySelector(".e-modal");

    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.remove("active");
        }
    });
};

const toggleModalNewModify = () => {
    const newBtn = getToggleModalBtn("new");
    const modifyBtn = getToggleModalBtn("modify");

    newBtn.addEventListener("click", () => {
        setModalNew();
    });
    modifyBtn.addEventListener("click", () => {
        setModalModify();
    });
};

const setModalNew = () => {
    const newBtn = getToggleModalBtn("new");
    const modifyBtn = getToggleModalBtn("modify");
    const deleteBtn = getModalSubmitBtn("delete");
    const newInput = getModalInput("new");
    const newSelect = newInput.querySelector("input");
    const modifyInput = getModalInput("modify");
    const modifySelect = modifyInput.querySelector("select");
    const newModify = getModalInputNewModify();
    newModify.value = "new";

    newBtn.classList.add("active");
    modifyBtn.classList.remove("active");
    deleteBtn.classList.remove("active");
    newSelect.value = "";
    modifySelect.value = "";
    modifySelect.disabled = true;
    modifySelect.required = false;
};

const setModalModify = () => {
    const newBtn = getToggleModalBtn("new");
    const modifyBtn = getToggleModalBtn("modify");
    const deleteBtn = getModalSubmitBtn("delete");
    const newInput = getModalInput("new");
    const newSelect = newInput.querySelector("input");
    const modifyInput = getModalInput("modify");
    const modifySelect = modifyInput.querySelector("select");
    const newModify = getModalInputNewModify();
    newModify.value = "modify";

    newBtn.classList.remove("active");
    modifyBtn.classList.add("active");
    deleteBtn.classList.add("active");
    newSelect.value = "";
    modifySelect.value = "";
    modifySelect.disabled = false;
    modifySelect.required = true;
};

const toggleModalIncomeExpense = () => {
    const expenseBtn = getToggleModalBtn("expense");
    const incomeBtn = getToggleModalBtn("income");

    expenseBtn.addEventListener("click", () => {
        setModalExpense();
    });
    incomeBtn.addEventListener("click", () => {
        setModalIncome();
    });
};

const setModalIncome = () => {
    const incomeBtn = getToggleModalBtn("income");
    const expenseBtn = getToggleModalBtn("expense");
    const submitBtn = getModalSubmitBtn("save");
    const type = getModalInputType();
    type.value = "income";

    incomeBtn.classList.add("active");
    expenseBtn.classList.remove("active");
    submitBtn.classList.remove("expense");
    submitBtn.classList.add("income");
    setModalCategory("income");
};

const setModalExpense = () => {
    const incomeBtn = getToggleModalBtn("income");
    const expenseBtn = getToggleModalBtn("expense");
    const submitBtn = getModalSubmitBtn("save");
    const type = getModalInputType();
    type.value = "expense";

    expenseBtn.classList.add("active");
    incomeBtn.classList.remove("active");
    submitBtn.classList.remove("income");
    submitBtn.classList.add("expense");
    setModalCategory("expense");
};

const setModalCategory = (type) => {
    const category = document.querySelector(
        '.e-modal .e-form .e-input select[name="category"]'
    );
    category.innerHTML = "";
    let option = document.createElement("option");
    option.value = "";
    option.text = "";
    category.appendChild(option);

    const filterCategories = categories.filter((cat) => cat.type === type);

    filterCategories.forEach((cat) => {
        let option = document.createElement("option");
        option.value = cat.id;
        option.text = cat.name;
        category.appendChild(option);
    });
};

const onModalSave = () => {
    const form = getModalForm();
    const saveBtn = getModalSubmitBtn("save");

    saveBtn.addEventListener("click", async () => {
        const data = {
            newModify: form.newModify.value,
            type: form.type.value,
            category: form.category.value,
            name: form.name.value,
        };

        const csrfToken = getCsrfToken();

        const res = await fetch("/upsertCategory", {
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

        alert("カテゴリを更新しました");

        categories = result;

        const modal = document.querySelector(".e-modal");
        modal.classList.remove("active");
        const type = getInputType();
        setCategory(type.value);
    });
};

const onModalDelete = () => {
    const form = getModalForm();
    const deleteBtn = getModalSubmitBtn("delete");

    deleteBtn.addEventListener("click", async () => {
        const data = {
            category: form.category.value,
        };

        const csrfToken = getCsrfToken();

        const res = await fetch("/deleteCategory", {
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

        if ("message" in result) {
            alert(result.message);
            return;
        }

        alert("カテゴリを削除しました");

        categories = result;

        const modal = document.querySelector(".e-modal");
        modal.classList.remove("active");
        const type = getInputType();
        setCategory(type.value);
    });
};

onAddItem();
onCloseBtn();
toggleIncomeExpense();
valicationDate();
onSave();
onDelete();
onCategory();
onModal();
toggleModalNewModify();
toggleModalIncomeExpense();
onModalSave();
onModalDelete();
