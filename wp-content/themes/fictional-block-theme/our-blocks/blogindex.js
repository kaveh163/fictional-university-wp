wp.blocks.registerBlockType("ourblocktheme/blogindex", {
    apiVersion: 2,
    title: "Fictional University Blog Index",
  
    edit: function () {
      //second argument of createElement is an object of props. for example className
      return wp.element.createElement(
        "div",
        { className: "our-placeholder-block" },
        "Blog Index Placeholder"
      );
    },
    save: function () {
      return null;
    },
  });
  