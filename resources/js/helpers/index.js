export const data2query = (data) => {
    let query = "?";
    let temp = [];
    for (const key in data) {
        if (Object.hasOwnProperty.call(data, key)) {
            const value = data[key];
            temp.push(`${key}=${value}`);
        }
    }
    query += temp.join('&');
    return query;
};