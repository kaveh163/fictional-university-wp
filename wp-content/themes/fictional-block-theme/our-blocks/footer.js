wp.blocks.registerBlockType("ourblocktheme/footer", {
  apiVersion: 2,
  title: "Fictional University Footer",

  edit: function () {
    //second argument of createElement is an object of props. for example className
    return wp.element.createElement(
      "div",
      { className: "our-placeholder-block" },
      "Footer Placeholder"
    );
  },
  save: function () {
    return null;
  },
});
