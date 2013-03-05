# Sound of the City Dashboard

This document explains the purpose and architecture of the SotC Dashboard.

## Purpose

The project [Sound of the City](http://citysound.itm.uni-luebeck.de) (SotC) was developed at the University of Luebeck, Germany. Its purpose is to provide an authoring, navigation and visualization service for geo-tagged noises and sound feeds. At the core of SotC is a community-based approach to use user's mobile phones to act as live geo-noise and geo-sound sensors. Users can either upload their own content or observe noise levels and sounds by navigating through an interactive map of their surrounding area.

In its initial implementation, the service used SOAP for client-server-communication. [Server One](https://github.com/nepa/Server-One), the media backend of SotC, is available as open-source software on GitHub. Although the repository is outdated, it gives a good impression of the project's capabilities. Later the [Sound of the City REST API](https://github.com/nepa/sotc-rest-api) was introduced, to achieve better access to the available data. Interested parties are invited to join the project and build their own applications based on the API.

With the Sound of the City Dashboard, we now provide a statistics tool that is also based upon the SotC REST API. The application can fetch accumulated use data from our live server and visualizes it in various charts. All diagrams are drawn dynamically, in order to show most recent information about, for example, noise level reports, sample uploads and unique users.

## Architecture

TODO

## History

TODO

## Author

The SotC Dashboard was written by: **Sascha Seidel**, NetPanther@gmx.net

Feel free to fork this repository and to modify the project.
