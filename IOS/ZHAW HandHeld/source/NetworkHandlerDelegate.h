//
//  NetworkHandlerDelegate.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 11.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <Foundation/Foundation.h>

@protocol NetworkHandlerDelegate <NSObject>

@optional

@required
-(void)connectionStatusUpdated;

@end
