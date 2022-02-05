---
layout: documentation
title: File Processors

---

# The Default Processors

Vaseman has these default file processors:

- TwigProcessor
- MarkdownProcessor
- MdProcessor (Alias of MarkdownProcessor)
- GeneralProcessor (All files not defined)

# Create Custom Processor

Create this class in `src/Vaseman/File/LessProcessor.php` or `src/File/LessProcessor.php` if in outer project.

``` php
<?php

namespace Vaseman\File;

class LessProcessor extends AbstractFileProcessor
{
	/**
	 * render
	 *
	 * @return  string
	 */
	public function render()
	{
        return $this->output = Less::compile($this->file->getPathname());
	}
}
```

Processor will run every files, you can decide what you want to do for any file type.
