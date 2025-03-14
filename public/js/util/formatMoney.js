export const formatStringToNumber = (stringMoney) => {
    return stringMoney.replace(/,/g, "").replace("¥", "");
};

export const formatSpreadMonry = (money) => {
    return `¥${Number(money).toLocaleString()}`;
};
