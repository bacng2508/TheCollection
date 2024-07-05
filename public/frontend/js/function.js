function formatCash(numberStr, currency = 'đ') {
    return (
        numberStr
            .split("")
            .reverse()
            .reduce((prev, next, index) => {
                return (index % 3 ? next : next + ",") + prev;
            }) + ` ${currency}`
    );
}


