export const getDetailHeaderDate = () => {
    return document.querySelector(".e-detail .e-header .e-dates .e-date");
};

export const getForm = () => {
    return document.querySelector(".e-input-form .e-form");
};

export const getInputForm = () => {
    return document.querySelector(".e-input-form");
};

export const getToggleBtn = (type) => {
    return document.querySelector(`.e-form .e-select .e-box.${type}`);
};

export const getSubmitBtn = (type) => {
    return document.querySelector(`.e-form .e-submit.${type}`);
};

export const getInputType = () => {
    return document.querySelector('.e-form input[name="type"]');
};

export const getInputDate = () => {
    return document.querySelector('.e-form .e-input input[type="date"]');
};

export const getBalanceCard = (type) => {
    return document.querySelector(`.c-balance-card.${type} .e-amount`);
};

export const getBalanceCardMini = (type) => {
    return document.querySelector(`.c-balance-card-mini .e-amount.${type}`);
};

export const getCategoryIcon = () => {
    return document.querySelector(".e-category-icon path");
};

export const getToggleModalBtn = (type) => {
    return document.querySelector(`.e-modal .e-select .e-box.${type}`);
};

export const getModalSubmitBtn = (type) => {
    return document.querySelector(`.e-modal .e-form .e-submit.${type}`);
};

export const getModalInputType = () => {
    return document.querySelector(".e-modal .e-form input[name='type']");
};

export const getModalInputNewModify = () => {
    return document.querySelector(".e-modal .e-form input[name='newModify']");
};

export const getModalInput = (type) => {
    return document.querySelector(`.e-modal .e-form .e-input.${type}`);
};

export const getModalForm = () => {
    return document.querySelector(".e-modal .e-form");
};
