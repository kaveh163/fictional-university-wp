wp.blocks.registerBlockType("ourblocktheme/page", {
    apiVersion: 2,
    title: "Fictional University Page",
  
    edit: function () {
      //second argument of createElement is an object of props. for example className
      return wp.element.createElement(
        "div",
        { className: "our-placeholder-block" },
        "Single Page Placeholder"
      );
    },
    save: function () {
      return null;
    },
  });
  