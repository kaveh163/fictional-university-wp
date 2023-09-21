wp.blocks.registerBlockType("ourblocktheme/singleprofessor", {
    apiVersion: 2,
    title: "Fictional University Single Professor",
  
    edit: function () {
      //second argument of createElement is an object of props. for example className
      return wp.element.createElement(
        "div",
        { className: "our-placeholder-block" },
        "Single Professor Placeholder"
      );
    },
    save: function () {
      return null;
    },
  });
  