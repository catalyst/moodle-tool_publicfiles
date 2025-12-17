
[![ci](https://github.com/catalyst/moodle-tool_publicfiles/actions/workflows/ci.yml/badge.svg?branch=MOODLE_405_STABLE)](https://github.com/catalyst/moodle-tool_publicfiles/actions/workflows/ci.yml?branch=MOODLE_405_STABLE)

# What is this?

This is a very simple Moodle admin tool which allows you to upload arbitrary
files like fonts, js or css, and then serves them as a pluginfile with
long lived expires headers so they will be cache by reverse proxy servers
like varnish or CDN's.

This makes it easy to add them into custom theme settings without needing
to bake the files into a theme or change anything in code.

