# ITCSS

## Features

### Numeric (`01_settings/`)

Each ITCSS folder has a numeric prefix so it shown in the right ITCSS order. This makes it easier to find files.

### Double underscore files (`__index.scss`)

The main Index file in each ITCSS folder contains a double underscore so it is always shown on top within the folder structure. From this main file you can import other SCSS files.

## Folder structure

1. **Settings** – used with preprocessors and contain font, colors definitions, etc.
2. **Tools** – globally used mixins and functions. It’s important not to output any CSS in the first 2 layers.
3. **Generic** – reset and/or normalize styles, box-sizing definition, root css variables, etc. This is the first layer which generates actual CSS.
4. **Elements** – styling for bare HTML elements (like `H1`, `A`, etc.). These come with default styling from the browser so we can redefine them here.
5. **Objects** – class-based selectors which define undecorated design patterns.
6. **Components** – specific UI components. This is where majority of our work takes place and our UI components are often composed of Objects and Components. **BEM** is a good methology to use here.
7. **Utilities** – utilities and helper classes with ability to override anything which goes before in the triangle, eg. hide helper class. The utilities folder should be the only folder were `!important` may be used.

## CSS Architecture Using SASS, BEM, and ITCSS

\*\*## CSS Architecture Using SASS, BEM, and ITCSS

### Folder Structure Explanation

- The `06_components/` folder consists of several sub-folders like `header/`, `pages/`, and component-specific styles like `_button.scss`, `_footer.scss`, etc.
- Each `pages/` sub-folder (e.g., `home/`, `producto/`) contains its SCSS files, and an `__**index.scss` for consolidating imports.
- It's essential that pages within `src/public/sass/Pages/` should only import `**__index.scss` files from their respective component sub-folders in `06_components/`.
- Example: `src/public/sass/Pages/home.scss` should only import from `src/public/sass/ITCSS/06_components/pages/home/`.

### BEM Methodology and Folder Structure

- In the `05_objects/` and `06_components/` folders, any file created, except for the `__index.scss` files, is considered as the name of the Block element within the BEM pattern.
- Therefore, if you create a file named `_block.scss`, your SASS should not include patterns like:

```scss
.blocking {
     &__element {
        ...
     }
  }

  // or

  .block {
     &__element {
        ...
     }
  }
  .other-block { // Invalid, adding another block here
     &__element {
        ...
     }
  }
```

- Instead, the name of any block here must match the name of the file. Only a structure like this is valid:

```scss
.block {
   &__element {
      ...
   }
}
```

- This convention ensures consistency in naming and helps maintain the BEM structure throughout the project.

### Relative Paths in Imports

- Always use relative paths for importing SCSS files to leverage the benefits of VSCode's features and maintain project consistency.
- Instead of
  `@use 'TCSS/06_components/footer'`
  use
  `@use '../ITCSS/06_components/footer'`

### Prohibition of @import

- Avoid using `@import` in favor of `@use` and/or `@forward` to manage SCSS file dependencies.

### SASS Variable Management

- New SASS variables should be added at `src/public/sass/ITCSS/01_settings`.
- Avoid creating CSS variables at other levels unless absolutely necessary.

### External Library Code Inclusion

- For including code from external libraries that don't follow BEM and require style modifications, create a specific SCSS file within the component.
- Disable specific Stylelint rules for these files to bypass Stylelint checks.
- Example: `_swal2.scss` in `06_components/pages/home/form/` with Stylelint rules disabled for sweetalert style modifications.

### Color Usage

- Primarily use colors defined in `src/public/sass/ITCSS/01_settings/_colors.scss`.
- Analyze the necessity before adding new colors and add them to `_colors.scss` if needed.

### Font Weight Variables

- Utilize SASS font weight variables from `src/public/sass/ITCSS/01_settings/_fonts.scss` instead of standalone font weight values.

### Using Rem and Em Units

- **Preference for Rem/Em**: Avoid using pixels (`px`). Prefer `rem` or `em` units as they offer responsive and scalable styling.
- **Advantages**: Thinking of 1rem as 16px provides a simple baseline for scaling. This approach enhances accessibility and ease of maintaining responsive designs.\*\*

### Try to use the new Container Query Length Units

#### Container Query Units (CQ Units)

- **cqw**: 1% of the container's width
- **cqh**: 1% of the container's height
- **cqi**: 1% of the container's inline size
- **cqb**: 1% of the container's block size
- **cqmin**: Smaller of cqi and cqb
- **cqmax**: Larger of cqi and cqb

#### Viewport Units

- **vw (viewport width)**: 1vw = 1% of the browser's width
- **vh (viewport height)**: 1vh = 1% of the browser's height
- **vmin (viewport minimum)**: 1vmin = 1% of the smaller viewport dimension (width or height)
- **vmax (viewport maximum)**: 1vmax = 1% of the larger viewport dimension (width or height)
- **vi (viewport inline)**: Logical inline version of vw/vh ([More on logical properties](https://developer.mozilla.org/en-US/docs/Web/CSS/logical_properties))
- **vb (viewport block)**: Logical block version of vw/vh ([More on logical properties](https://developer.mozilla.org/en-US/docs/Web/CSS/logical_properties))

#### Variable Viewport Units

- **svw/lvw/dvw (scaled/limited/dynamic viewport width)**: Relative to browser width
- **svh/lvh/dvh (scaled/limited/dynamic viewport height)**: Relative to browser height
- **svmin/lvmin/dvmin (scaled/limited/dynamic viewport minimum)**: Relative to the smaller viewport dimension
- **svmax/lvmax/dvmax (scaled/limited/dynamic viewport maximum)**: Relative to the larger viewport dimension
- **svi/lvi/dvi (scaled/limited/dynamic viewport inline)**: Logical inline version of *vw/*vh
- **svb/lvb/dvb (scaled/limited/dynamic viewport block)**: Logical block version of *vw/*vh

### Media Queries Strategies

#### Nested Approach

- Used within BEM block, element, and modifier selectors.
- Recommended for files with less than 100 lines for better readability and maintenance.

```scss
.block {
  // Base styles

  &__element {
    // Element base styles

    @include tablet() {
      // Tablet styles for the element
    }
  }
}
```

#### Non-Nested Approach

- Media queries placed at the end of the SASS block or file.
- Suitable for files with more than 100 lines, providing a clear overview of responsive changes.

```scss
.block {
  // Base styles
}

.block__element {
  // Element base styles
}

@include tablet() {
  .block__element {
    // Tablet styles for the element
  }
}
```

### BEM Usage and Folder Structure

- Apply BEM methodology in `05_objects` and `06_components` folders.
- This helps in structuring CSS components and objects effectively.

### Stylelint Configuration

- **Root Configuration**: Base stylelint setup at the project root.
- **SASS/ITCSS Folder Configuration**: Extends the root configuration, tailored for SASS/ITCSS structure.

```json
// .stylelintrc at the project root
{
  // ... root configuration details ...
}

// .stylelintrc in src/public/sass/ITCSS
{
  // ... extended configuration details ...
}
```

### Global CSS Configurations for Plugins

Place global CSS configurations of external plugins or libraries in the `src/public/sass/Plugins/` folder.

### Page Specific Styles

Each page of the site should have its own `.scss` file without an underscore in the `/PAGES` folder, parallel to the ITCSS folder: `src/public/sass/Pages/`.

## External resources

- [ITCSS: Scalable and Maintainable CSS Architecture](https://www.xfive.co/blog/itcss-scalable-maintainable-css-architecture/)
- [Harry Roberts - Managing CSS Projects with ITCSS](https://www.youtube.com/watch?v=1OKZOV-iLj4)
- [BEM Methodology](https://en.bem.info/methodology/)
- [CSS Methodologies and Architectures: OOCSS, BEM, SMACSS, ITCSS, Atomic Design](https://medium.com/williambastidasblog/metodologías-o-arquitecturas-css-oocss-bem-smacss-itcss-atomic-design-a1a3cfbfa6c9)
- [Atomic Web Design by Brad Frost](https://bradfrost.com/blog/post/atomic-web-design/)
- [ITCSS: What is it and its foundations](https://desarrolloweb.com/articulos/itcss-que-es-bases.html)
- [CSS Container Queries](https://developer.mozilla.org/es/docs/Web/CSS/CSS_container_queries)
- [CSS Length Units: Relative to the Viewport](https://lenguajecss.com/css/unidades-css/relativas-viewport/)
