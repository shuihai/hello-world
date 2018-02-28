from pandas import Series,DataFrame
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
from numpy.random import randn
from datetime import datetime
from datetime import timedelta


def testread_csv():
    # result = pd.read_csv('ex6.csv')
    # print result
    chunker = pd.read_csv('ex6.csv', chunksize=1000)
    print chunker
    for top in chunker:
        print top


def testhuatu():
    # plt.plot(np.arange(10))
    fig = plt.figure()
    ax1 = fig.add_subplot(2, 2, 1)
    ax2 = fig.add_subplot(2, 2, 2)
    ax3 = fig.add_subplot(2, 2, 3)
    plt.plot(randn(300000).cumsum(), 'k--')
    ax1.hist(randn(100), bins=10, color='k', alpha=0.3)
    ax2.scatter(np.arange(30), np.arange(30) + 3 * randn(30))
    plt.show()

def testsubplots():
    fig, axes = plt.subplots(2, 3)
    axes[0,1].plot(randn(300000).cumsum(), 'k--')
    plt.show()

def testsubplots2():
    fig, axes = plt.subplots(2, 2, sharex=True, sharey=True)
    for i in range(2):
        for j in range(2):
            axes[i, j].hist(randn(500), bins=50, color='k', alpha=0.5)
    plt.subplots_adjust(wspace=0.1, hspace=0.1,left=None)
    plt.show()

def testsubplots3():
    fig, axes = plt.subplots(1, 1)
    # axes.plot(randn(30).cumsum(), color='k', linestyle='dashed', marker='o')
    # axes.plot((2,4,5), color='g', linestyle='dashed', marker='o')
    plt.plot(randn(30).cumsum(), 'k-', drawstyle='steps-post', label='steps-post')
    plt.show()


def testsubplots4():
    fig = plt.figure();
    ax = fig.add_subplot(2, 2, 3)
    ax.plot(randn(1000).cumsum())
    ticks = ax.set_xticks([0, 250, 500, 750, 1000])
    ticks = ax.set_yticks([0, 250, 500, 750, 1000])
    # labels = ax.set_xticklabels(['one', 'two', 'three', 'four', 'five'], rotation = 30, fontsize = 'small')
    ax.set_title('My first matplotlib plot')
    ax.set_xlabel('Stages')
    ax.set_xlabel('Hehe')
    plt.show()


def testsubplots5():
    fig = plt.figure()
    ax = fig.add_subplot(1, 1, 1)
    ax.plot(randn(1000).cumsum(), 'k', label='one')
    ax.plot(randn(1000).cumsum(), 'k', label='two')
    ax.legend(loc='best')
    plt.show()


def testsubplots6():
    from datetime import datetime
    fig = plt.figure()
    ax = fig.add_subplot(1, 1, 1)
    data = pd.read_csv('spx.csv', index_col=0, parse_dates=True)
    spx = data['SPX']
    spx.plot(ax=ax, style='k-')
    crisis_data = [
        (datetime(2007, 10, 11), 'Peak of bull market'),
        (datetime(2008, 3, 12), 'Bear Stearns Fails'),
        (datetime(2008, 9, 15), 'Lehman Bankruptcy')
    ]
    for date, label in crisis_data:
        print spx.asof(date)
        ax.annotate(label, xy=(date, spx.asof(date) + 100),
                    xytext=(date, spx.asof(date) + 200),
                    arrowprops=dict(facecolor='black'),
                    horizontalalignment='left', verticalalignment='top')
    ax.set_xlim(['1/1/2007', '1/1/2011'])
    ax.set_ylim([600, 1800])
    ax.set_title('Important dates in 2008-2009 financial crisis')
    plt.show()

def testsubplots7():
    fig = plt.figure()
    plt.subplots(2, 2)
    plt.plot(randn(1000).cumsum(), 'k', label='one')
    plt.show()

    # ax = fig.add_subplot(1, 1, 1)
    # rect = plt.Rectangle((0.2, 0.75), 0.4, 0.15, color='k', alpha=0.3)
    # circ = plt.Circle((0.7, 0.2), 0.15, color='b', alpha=0.3)
    # pgon = plt.Polygon([[0.15, 0.15], [0.35, 0.4], [0.2, 0.6]],
    #                    color='g', alpha=0.5)
    # ax.add_patch(rect)
    # ax.add_patch(circ)
    # ax.add_patch(pgon)
    # plt.show()

def testsubplots8():
    fig = plt.figure()
    ax = fig.add_subplot(1, 1, 1)
    rect = plt.Rectangle((0.2, 0.75), 0.4, 0.15, color='k', alpha=0.3)
    circ = plt.Circle((0.7, 0.2), 0.15, color='b', alpha=0.3)
    pgon = plt.Polygon([[0.15, 0.15], [0.35, 0.4], [0.2, 0.6]],
                       color='g', alpha=0.5)
    ax.add_patch(rect)
    ax.add_patch(circ)
    ax.add_patch(pgon)
    plt.show()


def testsubplots9():
    fig = plt.figure()
    ax = fig.add_subplot(1, 1, 1)
    rect = plt.Rectangle((0.2, 0.75), 0.4, 0.15, color='k', alpha=0.3)
    circ = plt.Circle((0.7, 0.2), 0.15, color='b', alpha=0.3)
    pgon = plt.Polygon([[0.15, 0.15], [0.35, 0.4], [0.2, 0.6]],
                       color='g', alpha=0.5)
    ax.add_patch(rect)
    ax.add_patch(circ)
    ax.add_patch(pgon)
    from io import BytesIO as StringIO
    buffer = StringIO()
    plt.savefig(buffer)
    plot_data = buffer.getvalue()
    print plot_data


def testsubplots10():
    fig = plt.figure()
    ax = fig.add_subplot(1, 1, 1)
    rect = plt.Rectangle((0.2, 0.75), 0.4, 0.15, color='k', alpha=0.3)
    circ = plt.Circle((0.7, 0.2), 0.15, color='b', alpha=0.3)
    pgon = plt.Polygon([[0.15, 0.15], [0.35, 0.4], [0.2, 0.6]],
                       color='g', alpha=0.5)
    ax.add_patch(rect)
    ax.add_patch(circ)
    ax.add_patch(pgon)
    # font_options = {'family': 'monospace',
    #                 'weight': 'bold',
    #                 'size': 'small'}
    # plt.rc('fig', **font_options)
    plt.rc('fig', figsize=(10, 10))
    plt.show()

def testsubplots11():
    s = Series(np.random.randn(10).cumsum(), index=np.arange(0, 100, 10))
    s.plot()
    plt.savefig('figpath.svg')
    plt.show()


def testsubplots12():
    df = DataFrame(np.random.randn(10, 4).cumsum(0), columns=['A', 'B', 'C', 'D'], index=np.arange(0, 100, 10))
    df.plot()
    plt.show()

def testsubplots13():
    fig, axes = plt.subplots(2, 1)
    data = Series(np.random.rand(16), index=list('abcdefghijklmnop'))
    data.plot(kind='bar', ax=axes[0], color='k', alpha=0.7)
    data.plot(kind='barh', ax=axes[1], color='k', alpha=0.7)
    plt.show()

def testdatatime():
    now = datetime.now()
    print now.year
    delta = datetime(2011, 1, 7) - datetime(2008, 6, 24, 8, 15)
    print delta

def testdatatime1():
    from datetime import datetime
    dates = [datetime(2011, 1, 2), datetime(2011, 1, 5), datetime(2011, 1, 7),  datetime(2011, 1, 8), datetime(2011, 1, 10), datetime(2011, 1, 12)]
    ts = Series(np.random.randn(6), index=dates)
    print ts
    print ts[::2]


testdatatime1()

















