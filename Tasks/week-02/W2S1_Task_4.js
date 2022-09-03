let products = [
    {
        name:"smallRedShoe",
        keywords: ["small", "red", "shoe", "shoes"],
        category: "shoes",
        size: "small",

    },

    {
        name: "smallBlueShoe",
        keywords: ["small", "blue", "shoe", "shoes"],
        category: "shoes",
        size: "small"

    },

    {
        name: "smallGreenTshirt",
        keywords: ["small", "green", "tshirt", "tee-shirt", "t-shirt"],
        category: "tshirt",
        size: "small",
    },

    {
        name:"mediumGreenTshirt",
        keywords: ["medium", "green", "tshirt", "tee-shirt", "t-shirt"],
        category: "tshirt",
        size: "medium",
    },

    {
        name: "mediumRedTshirt",
        keywords: ["medium", "red", "tshirt", "tee-shirt", "t-shirt"],
        category: "tshirt",
        size: "medium",
    }
]


let productSearchForm = document.getElementById('shopping-search');

productSearchForm.addEventListener('submit', e => {
    const searchString = e.target.value;
    // This Line Below Needs Fixing
    const searchReturn = products.category.findIndex(keyword => {
        //
        return (
            keyword.keywords.includes(searchString)
        );
    });
    console.log(searchReturn);
});