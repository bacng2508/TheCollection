function formatCash(numberStr, currency = "đ") {
    if (numberStr) {
        numberStr = numberStr.toString();
        return (
            numberStr
                .split("")
                .reverse()
                .reduce((prev, next, index) => {
                    return (index % 3 ? next : next + ",") + prev;
                }) + ` ${currency}`
        );
    }
    return "";
    
}
